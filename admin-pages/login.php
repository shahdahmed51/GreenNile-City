<?php
session_start();

require_once "../config/connection.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";

    if (empty($email) || empty($password)) {

        $error = "Please fill all fields.";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $error = "Invalid email.";

    } else {

        $sql = "SELECT user_id, resident_id, username, email, password, role, status
                FROM users
                WHERE email = ?
                LIMIT 1";

        $stmt = mysqli_prepare($conn, $sql);

        if (!$stmt) {

            $error = "Database Error: " . mysqli_error($conn);

        } else {

            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) == 0) {

                $error = "Invalid email or password.";

            } else {

                $user = mysqli_fetch_assoc($result);

                if ($user["status"] !== "active") {

                    $error = "Your account is not active.";

<<<<<<< HEAD
                } elseif ($password !== $user["password"]) {
=======
                } elseif (!password_verify($password, $user["password"]) && $password !== $user["password"]) {
>>>>>>> 40803106bbc07b6f92d840af7a2618fa0df7d5c7

                    $error = "Invalid email or password.";

                } else {

                    session_regenerate_id(true);

                    $_SESSION["user_id"] = $user["user_id"];
                    $_SESSION["resident_id"] = $user["resident_id"];
                    $_SESSION["username"] = $user["username"];
                    $_SESSION["email"] = $user["email"];
                    $_SESSION["role"] = $user["role"];

                    $ip_address = $_SERVER["REMOTE_ADDR"];
                    $session_id = session_id();

                    $login_sql = "INSERT INTO login_sessions
                                  (session_id, user_id, login_time, ip_address)
                                  VALUES (?, ?, NOW(), ?)";

                    $login_stmt = mysqli_prepare($conn, $login_sql);

                    if ($login_stmt) {

                        mysqli_stmt_bind_param(
                            $login_stmt,
                            "sis",
                            $session_id,
                            $user["user_id"],
                            $ip_address
                        );

                        mysqli_stmt_execute($login_stmt);
                        mysqli_stmt_close($login_stmt);
                    }

                    mysqli_stmt_close($stmt);

                    if ($user["role"] === "resident") {

                        header("Location: ../admin-pages/register.php");
                        exit();

                    } elseif ($user["role"] === "admin") {

<<<<<<< HEAD
                        header("Location: ../admin-pages/settings.php");
=======
                        header("Location: ../admin-pages/register.php");
>>>>>>> 40803106bbc07b6f92d840af7a2618fa0df7d5c7
                        exit();

                    } else {

                        $error = "Invalid user role.";
                    }
                }
            }

            if (isset($stmt) && $stmt) {
                mysqli_stmt_close($stmt);
            }
        }
    }
}
?>

<?php include("../includes/header.php"); ?>

<link rel="stylesheet" href="/GREENNILE-CITY/assets/css/login.css">

<div class="container">

    <div class="left">

        <h1>Welcome Back !</h1>

        <p>Sign in to your account.</p>

        <?php
        if (!empty($error)) {
            echo "<p class='error'>" . htmlspecialchars($error) . "</p>";
        }
        ?>

        <form method="POST" id="loginForm">

            <label>Email</label>

            <input
                id="email"
                name="email"
                type="email"
                placeholder="Enter your email"
                required
            >

            <label>Password</label>

            <input
                id="password"
                name="password"
                type="password"
                placeholder="Enter your password"
                required
            >

            <div class="remember">

                <div class="check">

                    <input
                        type="checkbox"
                        id="remember"
                        name="remember"
                    >

                    <label for="remember">Remember me</label>

                </div>

            </div>

            <button id="loginBtn" type="submit">
                Login
            </button>

        </form>

        <p id="or">or continue with</p>

        <div class="social-icons">

            <a href="https://accounts.google.com" target="_blank">
                <i class="fa-brands fa-google"></i>
            </a>

            <a href="https://www.facebook.com/login/" target="_blank">
                <i class="fa-brands fa-facebook-f"></i>
            </a>

            <a href="#">
                <i class="fa-brands fa-apple"></i>
            </a>

        </div>

        <p class="stext">
            Don't have an account ?
            <a href="../admin-pages/register.php" id="sign">Sign Up</a>
        </p>

    </div>

    <div class="right">

        <img
            src="/GREENNILE-CITY/assets/images/login.jpeg"
            alt="house"
        >

    </div>

</div>

<script src="/GREENNILE-CITY/assets/js/login.js"></script>

<?php include("../includes/footer.php"); ?>