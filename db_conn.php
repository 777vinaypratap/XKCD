<?php
if (!defined('database')) {
    die('Nothing is available');
}
?>

<?php
$servername = 'localhost';
$username = 'XYZ';
$password = 'abcd';
$dbname = "Users";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die('Unable to connect to database:' . mysqli_connect_error());
}
?>