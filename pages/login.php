<?php
include("../includes/header.php");
?>

<link rel="stylesheet" href="/GREENNILE-CITY/assets/css/login.css">
<div class="container">

    <div class="left">

        <h1>Welcome Back !</h1>

        <p>Sign in to your account.</p>

        <form action="login.php" method="post" id="loginForm">

            <label>Email or Phone</label>

            <input id="email" name="email" type="email" placeholder="Enter your email">

            <p id="emailError"></p>

            <label>Password</label>

            <input id="password" name="password" type="password" placeholder="Enter your password">

            <p id="passwordError"></p>

            <div class="remember">

                <div class="check">
                    <input type="checkbox" id="remember">
                    <label for="remember">Remember me</label>
                </div>

            </div>

            <button id="loginBtn" type="submit">Login</button>

        </form>

        <p id="or">or continue with</p>

        <div class="social-icons">

            <a href="#"><i class="fa-brands fa-google"></i></a>
            <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="#"><i class="fa-brands fa-apple"></i></a>

        </div>

        <p>
            Don't have an account ?
            <a href="#" id="sign">Sign Up</a>
        </p>

    </div>

    <div class="right">
        <img src="/GREENNILE-CITY/assets/images/login.jpeg" alt="house">
    </div>
</div>
<script src="../assets/js/login.js"></script>

<?php
include("../includes/footer.php");
?>