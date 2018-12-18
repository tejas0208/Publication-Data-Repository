<?php

class DB {
	private $conn;
	private $server = "127.0.0.1";
	private $username = "ved";
	private $pass = "p@ssw0rd";
	private $db_name = "pubdata";
	function __construct() {
		$this->connect();
	}
	function connect() {
		$this->conn = mysqli_connect($this->server, $this->username, $this->pass, $this->db_name);
		if(!$this->conn) {
			throw new Exception(mysqli_error($conn));
		}
	}
	function run_query($query) {
		$result = mysqli_query($this->conn, $query);
		if(!$result) {
			throw new Exception($query .'<br>' .mysqli_error($this->conn));
		}
		return $result;
	}
}
?>
