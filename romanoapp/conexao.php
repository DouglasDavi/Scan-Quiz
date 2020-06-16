<?php 

$DB_HOST = "localhost";
$DB_USERNAME = "root";
$DB_PASSWORD = "";
$DB_NAME = "aplicativoquiz";


$mysqli = mysqli_connect($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);


if (!$mysqli) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
function db_query($sql){
	GLOBAL $mysqli;

	$result = mysqli_query($mysqli, $sql);
	return $result;
}

?>