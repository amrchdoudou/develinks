<?php
$host = "db";
$user = "root";
$password = "fdnZuQ4dKSb9";
$database = "student";

$connect = new mysqli($host, $user, $password, $database);

if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

?>
