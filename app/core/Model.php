<?php 
namespace App\Core;

use Mysqli;
use Exception;

class Model {
	private $host = DB_HOST,
			$user = DB_USER,
			$pass = DB_PASS,
			$dbname = DB_NAME;
	protected string $table;
	private $conn;
	private string $query = "";

	public function __construct()
	{
		try {
			$this->conn = new Mysqli($this->host, $this->user, $this->pass, $this->dbname);
			if ($this->conn->connect_error) {
				throw new Exception("Database Connection Failed " . $this->conn->connect_error);
			}
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	
	public function where($column, $value, $condition = "=")
	{
		$value = filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);

		if (str_contains($this->query, "WHERE")) {
			$this->query .= " AND $column $condition '$value'";
		} else {
			$this->query .= " WHERE $column $condition '$value'";
		}

		return $this;
	}
	public function orWhere($column, $value, $condition = "=")
	{
		if (str_contains($this->query, "WHERE")) {
			$value = filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
			$this->query .= " OR $column $condition '$value'";
		}

		return $this;
	}
	public function orderBy($column, $direction)
	{
		$this->query .= " ORDER BY {$column} {$direction}";
		return $this;
	}
	private function execute()
	{
		$query = $this->conn->query($this->query);
		return $query;
	}
	public function find(int $id): array
	{
		$id = filter_var($id, FILTER_SANITIZE_SPECIAL_CHARS);
		$this->query = "SELECT * FROM {$this->table} WHERE id = '$id'";

		$execute = $this->execute();
		if (gettype($execute) == "object") {
			if ($execute->num_rows > 0) {
				return $execute->fetch_assoc();
			} else {
				die("Data not found");
			}
		} else {
			die("A query error occurred");
		}
	}
	public function get(array $columns = []): array
	{
		if (count($columns)) {
			$join = join(",", $columns);
			$this->query = "SELECT {$join} FROM {$this->table}" . $this->query;
		} else {
			$this->query = "SELECT * FROM {$this->table}" . $this->query;
		}
		
		$execute = $this->execute();
		
		if (gettype($execute) == "object") {
			$result = [];
			while ($row = $execute->fetch_assoc()) {
				$result[] = $row;
			}
			return $result;
		} else {
			die("A query error occurred");
		}
	}
	public function insert(array $data = []): void
	{
		if (empty($data)) {
			die("Empty data, failed to save data");
		}

		$columns = implode(',', array_keys($data));
		$filterValues = array_map(function($value) {
			return filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
		}, array_values($data));

		foreach ($filterValues as $key => $value) {
			$filterValues[$key] = "'" . $value . "'";
		}

		$values = implode(",", $filterValues);

		$this->query = "INSERT INTO {$this->table} ($columns) VALUES ($values)";

		$execute = $this->execute();
		if (!$execute) {
			die("A query error occurred, failed to save data");
		}
	}
	public function update(array $data = []): void
	{
		if (empty($data)) {
			die("Empty data, failed to update data");
		} elseif (!str_contains($this->query, "WHERE")) {
			// update data harus ada kondisinya nya
			die("Update data must have conditions");
		} else {
			$columnValue = [];
			foreach ($data as $key => $value) {
				$value = filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
				array_push($columnValue, "$key='$value'");
			}

			$columnValue = implode(",", $columnValue);

			$this->query = "UPDATE {$this->table} SET {$columnValue}" . $this->query;
			$execute = $this->execute();

			if (!$execute) {
				die("A query error occurred, failed to update data");
			}
		}
	}
	public function delete(): void
	{
		if (!str_contains($this->query, "WHERE")) {
			die("Delete data must have conditions");
		}
		
		$this->query = "DELETE FROM {$this->table}" . $this->query;
		$execute = $this->execute();

		if (!$execute) {
			die("A query error occurred, failed to delete data");
		}
	}
}