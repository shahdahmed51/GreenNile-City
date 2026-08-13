<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


// ========================================
// CHECK IF USER IS LOGGED IN
// ========================================

if (!isset($_SESSION["user_id"])) {

    header("Location: ../admin-pages/login.php");
    exit();
}


// ========================================
// PREVENT CACHE
// ========================================

header("Cache-Control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

?>