<?php

session_start();

require_once "../config/connection.php";

$error = "";


// ========================================
// LOGIN
// ========================================

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";

<<<<<<< HEAD

    // ========================================
    // VALIDATION
    // ========================================

    if ($email === "" || $password === "") {
=======
    if (empty($email) || empty($password)) {
>>>>>>> ebfbe8eeb7a66946574c8c5e8a47ea2ec2e0df47

        $error = "Please fill all fields.";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $error = "Please enter a valid email address.";

    } elseif (strlen($password) < 8) {

        $error = "Password must be at least 8 characters.";

    } else {

<<<<<<< HEAD
=======
        $sql = "SELECT user_id, resident_id, username, email, password, role, status
                FROM users
                WHERE email = ?
                LIMIT 1";
>>>>>>> ebfbe8eeb7a66946574c8c5e8a47ea2ec2e0df47

        // ========================================
        // GET USER FROM DATABASE
        // ========================================

<<<<<<< HEAD
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


        $stmt = mysqli_prepare(
            $conn,
            $sql
        );


        if (!$stmt) {
=======
        if (!$stmt) {

            $error = "Database Error: " . mysqli_error($conn);

        } else {

            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) == 0) {
>>>>>>> ebfbe8eeb7a66946574c8c5e8a47ea2ec2e0df47

            $error = "Database Error.";

        } else {

            mysqli_stmt_bind_param(
                $stmt,
                "s",
                $email
            );


            mysqli_stmt_execute($stmt);


            $result =
                mysqli_stmt_get_result($stmt);


            // ========================================
            // USER NOT FOUND
            // ========================================

            if (
                !$result ||
                mysqli_num_rows($result) === 0
            ) {

                $error =
                    "Invalid email or password.";

            } else {

                $user =
                    mysqli_fetch_assoc($result);


                // ========================================
                // CHECK ACCOUNT STATUS
                // ========================================

                if ($user["status"] !== "active") {

<<<<<<< HEAD
                    $error =
                        "Your account is not active.";

                } else {

=======
                    $error = "Your account is not active.";

<<<<<<< HEAD
                } elseif ($password !== $user["password"]) {
=======
                } elseif (!password_verify($password, $user["password"]) && $password !== $user["password"]) {
>>>>>>> 40803106bbc07b6f92d840af7a2618fa0df7d5c7

                    $error = "Invalid email or password.";

                } else {

                    session_regenerate_id(true);
>>>>>>> ebfbe8eeb7a66946574c8c5e8a47ea2ec2e0df47

                    // ========================================
                    // CHECK PASSWORD
                    // ========================================

<<<<<<< HEAD
                    $password_valid = false;


                    /*
                     * Supports:
                     *
                     * 1. Hashed passwords
                     * 2. Old plain-text passwords
                     */
=======
                    $ip_address = $_SERVER["REMOTE_ADDR"];
                    $session_id = session_id();

                    $login_sql = "INSERT INTO login_sessions
                                  (session_id, user_id, login_time, ip_address)
                                  VALUES (?, ?, NOW(), ?)";
>>>>>>> ebfbe8eeb7a66946574c8c5e8a47ea2ec2e0df47


                    if (
                        password_get_info(
                            $user["password"]
                        )["algo"] !== 0
                    ) {

<<<<<<< HEAD
                        $password_valid =
                            password_verify(
                                $password,
                                $user["password"]
                            );
=======
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
>>>>>>> ebfbe8eeb7a66946574c8c5e8a47ea2ec2e0df47

                    } else {

                        $password_valid =
                            hash_equals(
                                $user["password"],
                                $password
                            );


                        // ========================================
                        // UPGRADE OLD PASSWORD
                        // ========================================

                        if ($password_valid) {

                            $new_hash =
                                password_hash(
                                    $password,
                                    PASSWORD_DEFAULT
                                );


                            $update_password_sql = "
                                UPDATE users
                                SET password = ?
                                WHERE user_id = ?
                            ";$update_password_stmt =
                                mysqli_prepare(
                                    $conn,
                                    $update_password_sql
                                );


                            if ($update_password_stmt) {

                                mysqli_stmt_bind_param(
                                    $update_password_stmt,
                                    "si",
                                    $new_hash,
                                    $user["user_id"]
                                );


                                mysqli_stmt_execute(
                                    $update_password_stmt
                                );


                                mysqli_stmt_close(
                                    $update_password_stmt
                                );
                            }
                        }
                    }


                    // ========================================
                    // INVALID PASSWORD
                    // ========================================

                    if (!$password_valid) {

                        $error =
                            "Invalid email or password.";

                    } else {// ========================================
                        // LOGIN SUCCESS
                        // ========================================

                        session_regenerate_id(true);


                        // ========================================
                        // SAVE USER DATA IN PHP SESSION
                        // ========================================

                        $_SESSION["user_id"] =
                            (int) $user["user_id"];


                        if (
                            !empty($user["resident_id"])
                        ) {

                            $_SESSION["resident_id"] =
                                (int) $user["resident_id"];

                        } else {

                            unset(
                                $_SESSION["resident_id"]
                            );
                        }


                        $_SESSION["username"] =
                            $user["username"];


                        $_SESSION["email"] =
                            $user["email"];


                        $_SESSION["role"] =
                            $user["role"];


                        // ========================================
                        // IP ADDRESS
                        // ========================================

                        $ip_address =
                            $_SERVER["REMOTE_ADDR"] ?? null;


                        // ========================================
                        // CREATE LOGIN SESSION
                        // ========================================

                        /*
                         * session_id in login_sessions
                         * is AUTO_INCREMENT.
                         *
                         * So we DON'T insert it manually.
                         */

                        $login_sql = "
                            INSERT INTO login_sessions
                            (
                                user_id,
                                login_time,
                                ip_address
                            )
                            VALUES
                            (
                                ?,
                                NOW(),
                                ?
                            )
                        ";


                        $login_stmt =
                            mysqli_prepare(
                                $conn,
                                $login_sql
                            );


                        if (!$login_stmt) {

                            $error =
                                "Could not create login session.";

                        } else {


                            mysqli_stmt_bind_param(
                                $login_stmt,
                                "is",
                                $user["user_id"],
                                $ip_address
                            );


                            if (
                                mysqli_stmt_execute(
                                    $login_stmt
                                )
                            ) {


                                // ========================================
                                // SAVE DATABASE SESSION ID
                                // ========================================

                                $_SESSION["login_session_id"] =
                                    mysqli_insert_id($conn);


                                mysqli_stmt_close(
                                    $login_stmt
                                );


                                // ========================================
                                // REDIRECT BY ROLE
                                // ========================================

                                if (
                                    $user["role"] === "resident"
                                ) {header(
                                        "Location: ../user-pages/parking.php"
                                    );

                                    exit();


                                } elseif (
                                    $user["role"] === "admin"
                                ) {

                                    header(
                                        "Location: dashboard.php"
                                    );

                                    exit();


                                } else {

                                    $error =
                                        "Invalid user role.";
                                }


                            } else {

                                $error =
                                    "Could not create login session.";

                                mysqli_stmt_close(
                                    $login_stmt
                                );
                            }
                        }
                    }
                }
            }


            mysqli_stmt_close($stmt);
        }
    }
}

?><?php include("../includes/header.php"); ?>


<link
    rel="stylesheet"
    href="/GREENNILE-CITY/assets/css/login.css"
>


<div class="container">

    <div class="left">


        <h1>
            Welcome Back !
        </h1>


        <p>
            Sign in to your account.
        </p>


        <?php if (!empty($error)): ?>

            <p class="error">

                <?= htmlspecialchars($error) ?>

            </p>

        <?php endif; ?>


        <form
            method="POST"
            id="loginForm"
        >


            <!-- EMAIL -->

            <label for="email">
                Email
            </label>


            <input
                id="email"
                name="email"
                type="email"
                placeholder="Enter your email"
                value="<?= htmlspecialchars($email ?? '') ?>"
                required
                autocomplete="email"
            >


            <!-- PASSWORD -->

            <label for="password">
                Password
            </label>


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

                    <input
                        type="checkbox"
                        id="remember"
                        name="remember"
                    >

                    <label for="remember">
                        Remember me
                    </label>

                </div>

            </div>


            <!-- LOGIN BUTTON -->

            <button
                id="loginBtn"
                type="submit"
            >

                Login

            </button>


        </form>


        <p id="or">
            or continue with
        </p>


        <div class="social-icons">


            <a
                href="https://accounts.google.com"
                target="_blank"
                rel="noopener noreferrer"
            >

                <i class="fa-brands fa-google"></i>

            </a>


            <a
                href="https://www.facebook.com/login/"
                target="_blank"
                rel="noopener noreferrer"
            >

                <i class="fa-brands fa-facebook-f"></i>

            </a>


            <a href="#">

                <i class="fa-brands fa-apple"></i>

            </a>


        </div>


        <p class="stext">

            Don't have an account ?
<<<<<<< HEAD

            <a
                href="register.php"
                id="sign"
            >
                Sign Up
            </a>

=======
            <a href="../admin-pages/register.php" id="sign">Sign Up</a>
>>>>>>> ebfbe8eeb7a66946574c8c5e8a47ea2ec2e0df47
        </p>


    </div>


    <div class="right">


        <img
            src="/GREENNILE-CITY/assets/images/login.jpeg"
            alt="house"
        >


    </div>


</div>


<script
    src="/GREENNILE-CITY/assets/js/login.js"
></script>


<?php include("../includes/footer.php"); ?>