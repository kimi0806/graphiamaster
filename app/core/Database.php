<?php
/**
 * 
 */
class Database
{
	protected $mysql;
	
	function __construct()
	{
		date_default_timezone_set('Asia/Manila');
	}

	protected function connect()
	{
		$mysql = new mysqli('localhost', 'u632857497_graphiaX', 'graphiaX123', 'u632857497_graphiamaster');

		if ($mysql->connect_error) {
		    die("Connection failed: " . $mysql->connect_error);
		}
		else {
			return $mysql;
		}
	}
}
?>