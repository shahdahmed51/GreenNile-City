<?php

$host = "localhost";
$username = "root";
$password = "";
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> ebfbe8eeb7a66946574c8c5e8a47ea2ec2e0df47
$database = "greennile";

=======
$database = "greennile"; 
>>>>>>> 40803106bbc07b6f92d840af7a2618fa0df7d5c7
$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8mb4");

?>