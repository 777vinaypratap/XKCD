<?php
if (!defined('database')) {
    die('Nothing is available');
}
$ini = parse_ini_file('php.ini');

$servername = $ini['db_server_name'];
$username = $ini['db_user'];
$password = $ini['db_pass'];
$dbname = $ini['db_name'];
$conn = new mysqli($servername, $username, $password, $dbname);
if(!$conn){
    die('ERROR: Could not connect. ' . $conn->connect_error);
}
?>