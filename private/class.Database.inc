<?php
require_once(LIB_PATH.DS."config.php");

class Database {

	private $server;
 	private $user;
	private $pwd;
	private $name;
	private $conn;
	public $last_query;

	function __construct() {
	}

	public function set_attributes($server, $user, $pwd, $db_name) {
		$this->server = $server;
		$this->user = $user;
		$this->pwd = $pwd;
		$this->name = $db_name;
	}

	public function open_connection() {
		$this->conn = mysqli_connect($this->server, $this->user, $this->pwd, $this->name);
		if(mysqli_connect_errno()) {
			// all this information can't go into production as it displays db connection details
			// die ("DB connection failed: ".mysqli_connect_error()." (".mysqli_connect_errno().")");
			// also beware of error handling in php.ini as those will display sensitive info as well
			die ("DB connection failed. That's as much info as u should get.");
		}
		$this->query("SET NAMES utf8");
		$this->query("SET CHARACTER SET utf8");
	}

	public function close_connection() {
		if (isset($this->conn)) { mysqli_close($this->conn); }
	}

	public function query($sql) {
		$this->last_query = $sql;
		$result = mysqli_query($this->conn, $sql);
		if (!$result) {
			die("EPIC DB FAIL MAN... better luck next time.<br>" . "Last query: " . $this->last_query );
		}
		return $result;
	}

	public function escape_string($string) {
		// this function CANNOT BE a static method as it makes use of an instance variable $this->conn
		$escaped_string = mysqli_real_escape_string($this->conn, $string);
		return $escaped_string;
	}

	public function insert_id() {
		//gives last id inserted over current connection
		return mysqli_insert_id($this->conn);
	}

	public function affected_rows() {
		return mysqli_affected_rows($this->conn);
	}

}

$local_db = new Database();
$local_db->set_attributes(LOCAL_SERVER, LOCAL_USER, LOCAL_PASS, LOCAL_DB);
$local_db->open_connection();

$nca_db = new Database();
$nca_db->set_attributes(PORTALE_SERVER, PORTALE_USER, PORTALE_PASS, PORTALE_DB);
$nca_db->open_connection();

$fp_db = new Database();
$fp_db->set_attributes(FP_SERVER, FP_USER, FP_PASS, FP_DB);


?>
