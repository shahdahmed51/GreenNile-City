<?php

session_start();

// Prevent browser from showing cached protected pages
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: 0");

// Not logged in
if (!isset($_SESSION["user_id"])) {

    $_SESSION["login_message"] =
        "Please login to access this page.";

    header("Location: ../admin-pages/login.php");
    exit();
}

// Logged in but not admin
if ($_SESSION["role"] !== "admin") {

    $_SESSION["login_message"] =
        "You don't have permission to access this page.";

    header("Location: ../admin-pages/login.php");
    exit();
}