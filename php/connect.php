<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "campus_grievance";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
// echo "Connected successfully"; // (use only for testing)
?>
