<?php
$servername = "sql206.infinityfree.com";
$username = "if0_41906289";
$password = "bewellproject11";
$database = "if0_41906289_fitness_db";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Database Connection Failed: " . mysqli_connect_error());
}
?>