<?php

session_start();

require_once "../config/connection.php";

$error = "";
$success = "";

$fullname = "";
$email = "";
$phone = "";
$role = "";


// ========================================
// REGISTER
// ========================================

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // ========================================
    // GET FORM DATA
    // ========================================

    $fullname = trim($_POST["fullname"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $phone = trim($_POST["phone"] ?? "");
    $password = $_POST["password"] ?? "";
    $confirm_password = $_POST["confirm-password"] ?? "";
    $role = $_POST["role"] ?? "";
    $agree = isset($_POST["agree"]);


    // ========================================
    // SERVER-SIDE VALIDATION
    // ========================================

    if (
        $fullname === "" ||
        $email === "" ||
        $phone === "" ||
        $password === "" ||
        $confirm_password === "" ||
        $role === ""
    ) {

        $error = "Please fill all required fields.";

    } elseif (strlen($fullname) < 3) {

        $error = "Full name must be at least 3 characters.";

    } elseif (strlen($fullname) > 100) {

        $error = "Full name must not exceed 100 characters.";

    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $fullname)) {

        $error = "Full name can contain letters and spaces only.";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $error = "Please enter a valid email address.";

    } elseif (strlen($email) > 100) {

        $error = "Email must not exceed 100 characters.";

    } elseif (!preg_match("/^[0-9]{10,15}$/", $phone)) {

        $error = "Phone number must contain 10 to 15 digits.";

    } elseif (strlen($password) < 8) {

        $error = "Password must be at least 8 characters.";

    } elseif (strlen($password) > 255) {

        $error = "Password is too long.";

    } elseif ($password !== $confirm_password) {

        $error = "Passwords do not match.";

    } elseif (!in_array($role, ["admin", "resident"], true)) {

        $error = "Please select a valid role.";

    } elseif (!$agree) {

        $error = "You must agree to the Terms & Conditions.";

    } else {

        // ========================================
        // CHECK DUPLICATE EMAIL
        // ========================================

        $check_sql = "
            SELECT user_id
            FROM users
            WHERE email = ?
            LIMIT 1
        ";

        $check_stmt = mysqli_prepare(
            $conn,
            $check_sql
        );

        if (!$check_stmt) {

            $error = "Database error.";

        } else {

            mysqli_stmt_bind_param(
                $check_stmt,
                "s",
                $email
            );

            mysqli_stmt_execute($check_stmt);

            $check_result =
                mysqli_stmt_get_result($check_stmt);


            if (
                $check_result &&
                mysqli_num_rows($check_result) > 0
            ) {

                $error =
                    "This email is already registered.";

            } else {

                // ========================================
                // START TRANSACTION
                // ========================================

                mysqli_begin_transaction($conn);

                try {

                    // ========================================
                    // INSERT RESIDENT
                    // ========================================

                    $resident_sql = "
                        INSERT INTO residents
                        (
                            full_name,
                            phone,
                            email
                        )
                        VALUES
                        (
                            ?,
                            ?,
                            ?
                        )
                    ";

                    $resident_stmt = mysqli_prepare(
                        $conn,
                        $resident_sql
                    );

                    if (!$resident_stmt) {

                        throw new Exception(
                            "Could not create resident."
                        );
                    }

                    mysqli_stmt_bind_param(
                        $resident_stmt,
                        "sss",
                        $fullname,
                        $phone,
                        $email
                    );

                    if (
                        !mysqli_stmt_execute(
                            $resident_stmt
                        )
                    ) {

                        throw new Exception(
                            "Could not create resident."
                        );
                    }

                    // Get resident ID
                    $resident_id =
                        mysqli_insert_id($conn);

                    mysqli_stmt_close(
                        $resident_stmt
                    );


                    // ========================================
                    // CREATE USERNAME
                    // ========================================

                    $username = strtolower(
                        preg_replace(
                            "/[^a-zA-Z0-9]+/",
                            "_",
                            $fullname
                        )
                    );

                    $username = trim(
                        $username,
                        "_"
                    );


                    if ($username === "") {

                        $username = "user";
                    }


                    // ========================================
                    // MAKE USERNAME UNIQUE
                    // ========================================

                    $base_username = $username;
                    $counter = 1;

                    while (true) {

                        $username_check_sql = "
                            SELECT user_id
                            FROM users
                            WHERE username = ?
                            LIMIT 1
                        ";

                        $username_stmt =
                            mysqli_prepare(
                                $conn,
                                $username_check_sql
                            );

                        if (!$username_stmt) {

                            throw new Exception(
                                "Could not check username."
                            );
                        }

                        mysqli_stmt_bind_param(
                            $username_stmt,
                            "s",
                            $username
                        );

                        mysqli_stmt_execute(
                            $username_stmt
                        );

                        $username_result =
                            mysqli_stmt_get_result(
                                $username_stmt
                            );

                        mysqli_stmt_close(
                            $username_stmt
                        );


                        if (
                            !$username_result ||
                            mysqli_num_rows(
                                $username_result
                            ) === 0
                        ) {

                            break;
                        }


                        $username =
                            $base_username .
                            "_" .
                            $counter;

                        $counter++;
                    }


                    // ========================================
                    // HASH PASSWORD
                    // ========================================

                    $hashed_password =
                        password_hash(
                            $password,
                            PASSWORD_DEFAULT
                        );


                    if ($hashed_password === false) {

                        throw new Exception(
                            "Could not secure password."
                        );
                    }


                    // ========================================
                    // INSERT USER
                    // ========================================

                    $user_sql = "
                        INSERT INTO users
                        (
                            resident_id,
                            username,
                            email,
                            password,
                            role,
                            status
                        )
                        VALUES
                        (
                            ?,
                            ?,
                            ?,
                            ?,
                            ?,
                            'active'
                        )
                    ";

                    $user_stmt = mysqli_prepare(
                        $conn,
                        $user_sql
                    );

                    if (!$user_stmt) {

                        throw new Exception(
                            "Could not create user."
                        );
                    }


                    mysqli_stmt_bind_param(
                        $user_stmt,
                        "issss",
                        $resident_id,
                        $username,
                        $email,
                        $hashed_password,
                        $role
                    );


                    if (
                        !mysqli_stmt_execute(
                            $user_stmt
                        )
                    ) {

                        throw new Exception(
                            "Could not create user."
                        );
                    }


                    mysqli_stmt_close(
                        $user_stmt
                    );


                    // ========================================
                    // COMMIT
                    // ========================================

                    mysqli_commit($conn);


                    $success =
                        "Account created successfully!";

                    // Clear form
                    $fullname = "";
                    $email = "";
                    $phone = "";
                    $role = "";


                } catch (Exception $e) {

                    // ========================================
                    // ROLLBACK
                    // ========================================

                    mysqli_rollback($conn);

                    $error =
                        "Registration failed. Please try again.";
                }
            }

            mysqli_stmt_close($check_stmt);
        }
    }
}

?>

<?php include("../includes/header.php"); ?>

<link
    rel="stylesheet"
    href="/GREENNILE-CITY/assets/css/register.css"
>

<body>

<div class="register-container">

    <!-- ========================================
         LEFT SIDE
    ========================================= -->

    <div class="register-card">

        <h2>Create Account</h2>

        <p class="subtitle">
            Join the GreenNile City Community
        </p>


        <!-- ========================================
             ERROR MESSAGE
        ========================================= -->

        <?php if (!empty($error)): ?>

            <div class="form-message error-message">

                <span>⚠</span>

                <span>
                    <?= htmlspecialchars($error) ?>
                </span>

            </div>

        <?php endif; ?>


        <!-- ========================================
             SUCCESS MESSAGE
        ========================================= -->

        <?php if (!empty($success)): ?>

            <div class="form-message success-message">

                <span>✓</span>

                <span>
                    <?= htmlspecialchars($success) ?>
                </span>

            </div>

        <?php endif; ?>


        <!-- ========================================
             REGISTER FORM
        ========================================= -->

        <form
            method="POST"
            action=""
        >

            <!-- FULL NAME -->

            <div class="input-group">

                <label for="fullname">

                    <span class="icons">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="16"
                            height="16"
                            fill="currentColor"
                            viewBox="0 0 16 16"
                        >
                            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                        </svg>

                    </span>

                    Full Name

                </label>


                <input
                    type="text"
                    id="fullname"
                    name="fullname"
                    placeholder="Enter your full name"
                    value="<?= htmlspecialchars($fullname) ?>"
                    required
                    minlength="3"
                    maxlength="100"
                    autocomplete="name"
                >

            </div>


            <!-- EMAIL -->

            <div class="input-group">

                <label for="email">

                    <span class="icons">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="16"
                            height="16"
                            fill="currentColor"
                            viewBox="0 0 16 16"
                        >
                            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 1-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z"/>
                        </svg>

                    </span>

                    Email

                </label>


                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Enter your email"
                    value="<?= htmlspecialchars($email) ?>"
                    required
                    maxlength="100"
                    autocomplete="email"
                >

            </div>


            <!-- PHONE -->

            <div class="input-group">

                <label for="phone">

                    <span class="icons">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="16"
                            height="16"
                            fill="currentColor"
                            viewBox="0 0 16 16"
                        >
                            <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58z"/>
                            <path d="M1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"/>
                        </svg>

                    </span>

                    Phone Number

                </label>


                <input
                    type="tel"
                    id="phone"
                    name="phone"
                    placeholder="Enter your phone number"
                    value="<?= htmlspecialchars($phone) ?>"
                    required
                    pattern="[0-9]{10,15}"
                    minlength="10"
                    maxlength="15"
                    inputmode="numeric"
                    autocomplete="tel"
                >

            </div>


            <!-- PASSWORD -->

            <div class="input-group">

                <label for="password">

                    <span class="icons">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="16"
                            height="16"
                            fill="currentColor"
                            viewBox="0 0 16 16"
                        >
                            <path d="M4.406 3.342A5.53 5.53 0 0 1 8 2c2.69 0 4.923 2 5.166 4.579C14.758 6.804 16 8.137 16 9.773 16 11.569 14.502 13 12.687 13H3.781C1.708 13 0 11.366 0 9.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383m.653.757c-.757.653-1.153 1.44-1.153 2.056v.448l-.445.049C2.064 6.805 1 7.952 1 9.318 1 10.785 2.23 12 3.781 12h8.906C13.98 12 15 10.988 15 9.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 4.825 10.328 3 8 3a4.53 4.53 0 0 0-2.941 1.1z"/>
                        </svg>

                    </span>

                    Password

                </label>


                <div class="password-box">

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Create a password"
                        minlength="8"
                        maxlength="255"
                        required
                        autocomplete="new-password"
                    >

                    <span class="eye">

                        <svg
                            class="eye-icon"
                            xmlns="http://www.w3.org/2000/svg"
                            width="20"
                            height="20"
                            fill="currentColor"
                            viewBox="0 0 16 16"
                        >
                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                            <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                        </svg>

                    </span>

                </div>

            </div>


            <!-- CONFIRM PASSWORD -->

            <div class="input-group">

                <label for="confirm-password">

                    <span class="icons">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="16"
                            height="16"
                            fill="currentColor"
                            viewBox="0 0 16 16"
                        >
                            <path fill-rule="evenodd" d="M10.354 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708 0"/>
                            <path d="M4.406 3.342A5.53 5.53 0 0 1 8 2c2.69 0 4.923 2 5.166 4.579C14.758 6.804 16 8.137 16 9.773 16 11.569 14.502 13 12.687 13H3.781C1.708 13 0 11.366 0 9.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383m.653.757c-.757.653-1.153 1.44-1.464 2.383z"/>
                        </svg>

                    </span>

                    Confirm Password

                </label>


                <div class="password-box">

                    <input
                        type="password"
                        id="confirm-password"
                        name="confirm-password"
                        placeholder="Confirm your password"
                        minlength="8"
                        maxlength="255"
                        required
                        autocomplete="new-password"
                    >

                    <span class="eye">

                        <svg
                            class="eye-icon"
                            xmlns="http://www.w3.org/2000/svg"
                            width="20"
                            height="20"
                            fill="currentColor"
                            viewBox="0 0 16 16"
                        >
                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                            <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                        </svg>

                    </span>

                </div>

            </div>


            <!-- TERMS -->

            <div class="checkbox">

                <input
                    type="checkbox"
                    id="agree"
                    name="agree"
                    required
                >

                <label for="agree">
                    I agree to the Terms &amp; Conditions
                </label>

            </div>


            <!-- REGISTER BUTTON -->

            <button
                type="submit"
                class="register-btn"
            >
                Register
            </button>


            <!-- LOGIN LINK -->

            <p class="login-link">

                Already have an account?

                <a href="login.php">
                    Login
                </a>

            </p>

        </form>

    </div>


    <!-- ========================================
         RIGHT SIDE
    ========================================= -->

    <div class="image-side">

        <img
            src="../assets/images/register.png"
            alt="GreenNile Building"
        >

    </div>

</div>


<script src="/GREENNILE-CITY/assets/js/register.js"></script>

</body>