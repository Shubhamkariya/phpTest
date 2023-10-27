<?php
$host = "localhost";
$port = "5432"; // Default PostgreSQL port
$database = "postgres";
$user = "postgres";
$password = "Shubhk@123";

$connection = pg_connect("host=$host port=$port dbname=$database user=$user password=$password");

if (!$connection) {
    die("Connection failed: " . pg_last_error());
}

// Perform your database operations here.

// Close the connection when you're done.

?>
