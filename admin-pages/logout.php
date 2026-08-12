<?php

session_start();

require_once("../config/connection.php");

// Get current PHP session ID
$session_id = session_id();

// Update logout time
$sql = "UPDATE login_sessions
        SET logout_time = NOW()
        WHERE session_id = ?
        AND logout_time IS NULL";

$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {

    mysqli_stmt_bind_param($stmt, "s", $session_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

// Destroy session
$_SESSION = [];

session_destroy();

// Go back to login page
header("Location: login.php");
exit();

?>