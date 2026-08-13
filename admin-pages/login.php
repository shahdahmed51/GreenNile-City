<?php
session_start();

require_once "../config/connection.php";

$error = "";
$email = "";
$login_message = $_SESSION["login_message"] ?? "";
unset($_SESSION["login_message"]);

// ========================================
// LOGIN
// ========================================

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";

    // ========================================
    // VALIDATION
    // ========================================

    if ($email === "" || $password === "") {

        $error = "Please fill all fields.";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $error = "Please enter a valid email address.";

    } elseif (strlen($password) < 8) {

        $error = "Password must be at least 8 characters.";

    } else {

        // ========================================
        // GET USER FROM DATABASE
        // ========================================

        $sql = "
            SELECT
                user_id,
                resident_id,
                username,
                email,
                password,
                role,
                status
            FROM users
            WHERE email = ?
            LIMIT 1
        ";

        $stmt = mysqli_prepare($conn, $sql);

        if (!$stmt) {

            $error = "Database Error.";

        } else {

            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            // ========================================
            // USER NOT FOUND
            // ========================================

            if (!$result || mysqli_num_rows($result) === 0) {

                $error = "Invalid email or password.";

            } else {

                $user = mysqli_fetch_assoc($result);

                // ========================================
                // CHECK ACCOUNT STATUS
                // ========================================

                if ($user["status"] !== "active") {

                    $error = "Your account is not active.";

                } else {

                    // ========================================
                    // CHECK PASSWORD
                    // ========================================

                    $dbPassword = trim((string)$user["password"]);
                    $inputPassword = trim((string)$password);

                    // دعم كلمة المرور المشفّرة بـ password_hash وكذلك النص العادي
                    $password_valid = password_verify($inputPassword, $dbPassword) || ($dbPassword === $inputPassword);

                    if (!$password_valid) {

                        $error = "Invalid email or password.";

                    } else {

                        // ========================================
                        // LOGIN SUCCESS
                        // ========================================

                        session_regenerate_id(true);

                        $_SESSION["user_id"] = (int)$user["user_id"];
                        $_SESSION["resident_id"] = !empty($user["resident_id"]) ? (int)$user["resident_id"] : null;
                        $_SESSION["username"] = $user["username"];
                        $_SESSION["email"] = $user["email"];
                        $_SESSION["role"] = $user["role"];

                        // ========================================
                        // LOGIN SESSION
                        // ========================================

                        $ip_address = $_SERVER["REMOTE_ADDR"] ?? null;

                        $login_sql = "
                            INSERT INTO login_sessions (user_id, login_time, ip_address)
                            VALUES (?, NOW(), ?)
                        ";

                        $login_stmt = mysqli_prepare($conn, $login_sql);

                        if (!$login_stmt) {

                            $error = "Could not create login session.";

                        } else {

                            mysqli_stmt_bind_param($login_stmt, "is", $user["user_id"], $ip_address);

                            if (mysqli_stmt_execute($login_stmt)) {

                                $_SESSION["login_session_id"] = mysqli_insert_id($conn);
                                mysqli_stmt_close($login_stmt);

                                // ========================================
                                // REDIRECT BY ROLE
                                // ========================================

                                if ($user["role"] === "admin") {

                                    header("Location: ../admin-pages/dashboard.php");
                                    exit();

                                } elseif ($user["role"] === "resident") {

                                    header("Location: ../user-pages/parking.php");
                                    exit();

                                } else {

                                    $error = "Invalid user role.";
                                }

                            } else {

                                $error = "Could not create login session.";
                                mysqli_stmt_close($login_stmt);
                            }
                        }
                    }
                }
            }

            mysqli_stmt_close($stmt);
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

        <?php if (!empty($error)): ?>
            <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <?php if (!empty($login_message)): ?>
            <div class="login-message">
                <i class="fa-solid fa-circle-info"></i>
                <span><?= htmlspecialchars($login_message) ?></span>
            </div>
        <?php endif; ?>

        <form method="POST" id="loginForm">

            <!-- EMAIL -->
            <label for="email">Email</label>
            <input
                id="email"
                name="email"
                type="email"
                placeholder="Enter your email"
                value="<?= htmlspecialchars($email) ?>"
                required
                autocomplete="email"
            >

            <!-- PASSWORD -->
            <label for="password">Password</label>
            <input
                id="password"
                name="password"
                type="password"
                placeholder="Enter your password"
                required
                minlength="8"
                autocomplete="current-password"
            >

            <!-- REMEMBER ME -->
            <div class="remember">
                <div class="check">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Remember me</label>
                </div>
            </div>

            <!-- LOGIN BUTTON -->
            <button id="loginBtn" type="submit">Login</button>

        </form>

        <p id="or">or continue with</p>

        <div class="social-icons">
            <a href="https://accounts.google.com" target="_blank" rel="noopener noreferrer">
                <i class="fa-brands fa-google"></i>
            </a>
            <a href="https://www.facebook.com/login/" target="_blank" rel="noopener noreferrer">
                <i class="fa-brands fa-facebook-f"></i>
            </a>
            <a href="#">
                <i class="fa-brands fa-apple"></i>
            </a>
        </div>

        <p class="stext">
            Don't have an account ?
            <a href="register.php" id="sign">Sign Up</a>
        </p>

    </div>

    <div class="right">
        <img src="/GREENNILE-CITY/assets/images/login.jpeg" alt="house">
    </div>

</div>

<script src="/GREENNILE-CITY/assets/js/login.js"></script>

<?php include("../includes/footer.php"); ?>