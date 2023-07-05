<?php

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'soccer';
$connect;
// Create a database connection
$connection = mysqli_connect($host, $username, $password, $database);

// Check if the connection was successful
if (!$connection) {
    die('Database connection failed: ' . mysqli_connect_error());
}

// Set the character set (optional)
mysqli_set_charset($connection, 'utf8');

?>
