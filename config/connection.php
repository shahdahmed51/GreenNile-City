<?php

$host = "localhost";
$username = "root";
$password = "";
<<<<<<< HEAD
$database = "greennile";   
=======
$database = "greennile.sql";

>>>>>>> a5f7e0c5a852f3372e2e1ddfcd44bd77c78344c1
$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8mb4");

?>