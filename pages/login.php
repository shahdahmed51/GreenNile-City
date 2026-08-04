<?php
if(isset($error)){
    echo "<p class='error'>$error</p>";
}
session_start();
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $email=$_POST["email"];
    $password=$_POST["password"];
    if(empty($email)||empty($password)){
        $error="please fill all fields ";
    }
    else{
        if($email=="admin@gmail.com" && $password=="123456"){
            $_SESSION["user"]=$email;
            header("Location : register.php");
            exit();
        }
        else{
            $error="Invalid email or password ";
        }
    }
}
include("../includes/header.php");
?>

<link rel="stylesheet" href="/GREENNILE-CITY/assets/css/login.css">
<div class="container">

    <div class="left">

        <h1>Welcome Back !</h1>

        <p>Sign in to your account.</p>

        <form method="POST" id="loginForm">

            <label>Email or Phone</label>

            <input id="email" name="email" type="email" placeholder="Enter your email">

            <p id="emailError"></p>

            <label>Password</label>

            <input id="password" name="password" type="password" placeholder="Enter your password">

            <p id="passwordError"></p>

            <div class="remember">

                <div class="check">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Remember me</label>
                </div>

            </div>

            <button id="loginBtn" type="submit">Login</button>

        </form>

        <p id="or">or continue with</p>

        <div class="social-icons">

            <a href="https://accounts.google.com" target="_blank"><i class="fa-brands fa-google"></i></a>
            <a href="https://www.facebook.com/login/" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="#"><i class="fa-brands fa-apple"></i></a>

        </div>

        <p>
            Don't have an account ?
            <a href="register.php" id="sign">Sign Up</a>
        </p>

    </div>

    <div class="right">
        <img src="/GREENNILE-CITY/assets/images/login.jpeg" alt="house">
    </div>
</div>
<script src="/GREENNILE-CITY/assets/js/login.js"></script>
 

<?php
include("../includes/footer.php");
?>