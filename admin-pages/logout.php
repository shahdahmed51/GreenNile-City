<?php

session_start();

require_once "../config/connection.php";


// ========================================
// UPDATE LOGOUT TIME
// ========================================

if (isset($_SESSION["login_session_id"])) {

    $login_session_id = (int) $_SESSION["login_session_id"];

    $sql = "
        UPDATE login_sessions
        SET logout_time = NOW()
        WHERE session_id = ?
        AND logout_time IS NULL
    ";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {

        mysqli_stmt_bind_param(
            $stmt,
            "i",
            $login_session_id
        );

        mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);
    }
}


// ========================================
// CLEAR SESSION
// ========================================

$_SESSION = [];


// ========================================
// DELETE SESSION COOKIE
// ========================================

if (ini_get("session.use_cookies")) {

    $params = session_get_cookie_params();

    setcookie(
        session_name(),
        "",
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}


// ========================================
// DESTROY SESSION
// ========================================

session_destroy();


// ========================================
// PREVENT CACHE
// ========================================

header("Cache-Control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");


// ========================================
// BACK TO LOGIN
// ========================================

header("Location: ../admin-pages/login.php");
exit();

?>