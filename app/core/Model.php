<?php 
namespace App\Core;

use Mysqli;
use Exception;

class Model {
	private $host = DB_HOST,
			$user = DB_USER,
			$pass = DB_PASS,
			$dbname = DB_NAME;
	private $conn;
	protected string $table;
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
	
	public function select(array $columns)
	{
		if (count($columns) > 0) {
			$join = join(",", $columns);
			$this->query = "SELECT {$join} FROM {$this->table}";
		}
		return $this;
	}
	public function where($column, $value, $condition = "=")
	{
		$value = "'" . $value . "'";
		if (str_contains($this->query, "WHERE")) {
			$this->query .= " AND {$column} {$condition} {$value}";
		} else {
			$this->query .= " WHERE {$column} {$condition} {$value}";
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
		$this->query = "SELECT * FROM {$this->table} WHERE id = '$id'";

		$execute = $this->execute();
		if (gettype($execute) == "object") {
			if ($execute->num_rows > 0) {
				return $execute->fetch_assoc();
			} else {
				http_response_code(404);
				exit;
			}
		} else {
			die("A query error occurred");
		}
	}
	public function get(): array
	{
		if (!str_contains($this->query, "SELECT")) {
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
	public function insert(array $data): void
	{
		if (empty($data)) {
			die("Empty data, failed to save data");
		}

		$column = [];
		$value = [];
		foreach ($data as $key => $val) {
			$column[] = $key;
			$value[] = "'". $val . "'";
		}
		$column = implode(",", $column);
		$value = implode(",", $value);

		$this->query = "INSERT INTO {$this->table} ($column) VALUES ($value)";

		$execute = $this->execute();
		if (!$execute) {
			die("A query error occurred, failed to save data");
		}
	}
	public function update(array $data): void
	{
		if (empty($data)) {
			die("Empty data, failed to update data");
		}

		$columnValue = [];
		foreach ($data as $key => $value) {
			array_push($columnValue, "$key='$value'");
		}
		$columnValue = implode(",", $columnValue);

		if (!str_contains($this->query, "WHERE")) {
			// update data harus ada kondisinya nya
			die("Update data must have conditions");
		} else {
			$this->query = "UPDATE {$this->table} SET {$columnValue}" . $this->query;
		}

		$execute = $this->execute();
		if (!$execute) {
			die("A query error occurred, failed to update data");
		}
	}
	public function delete(): void
	{
		if (!str_contains($this->query, "WHERE")) {
			die("Delete data must have conditions");
		} else {
			$this->query = "DELETE FROM {$this->table}" . $this->query;
		}

		$execute = $this->execute();
		if (!$execute) {
			die("A query error occurred, failed to delete data");
		}
	}
}