<?php 
namespace App\Core;

use mysqli;

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
		$this->conn = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
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
	public function count()
	{
		# code...
	}
	public function getQuery()
	{
		return $this->query;
	}
	private function execute()
	{
		$query = $this->conn->query($this->query);
		return $query;
	}
	public function find(int $id)
	{
		$this->query = "SELECT * FROM {$this->table} WHERE id = '$id'";

		$execute = $this->execute();

		if (gettype($execute) == "object") {
			return $execute->fetch_assoc();
		} else {
			die("Error Query Database");
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
			die("Error Query Database");
		}
	}
	public function insert(array $data = []): bool
	{
		if (empty($data)) {
			return false;
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

		return $this->execute();
	}
	public function update(array $data = []): bool
	{
		if (empty($data)) {
			return false;
		}

		$columnValue = [];
		foreach ($data as $key => $value) {
			array_push($columnValue, "$key='$value'");
		}
		$columnValue = implode(",", $columnValue);

		if (!str_contains($this->query, "WHERE")) {
			// update data harus ada WHERE nya
			return false;
		} else {
			$this->query = "UPDATE {$this->table} SET {$columnValue}" . $this->query;
		}

		return $this->execute();
	}
	public function delete(): bool
	{
		if (!str_contains($this->query, "WHERE")) {
			return false;
		} else {
			$this->query = "DELETE FROM {$this->table}" . $this->query;
		}

		return $this->execute();
	}
}