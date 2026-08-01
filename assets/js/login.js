let form = document.getElementById("loginForm");
let email = document.getElementById("email");
let password = document.getElementById("password");
let emailError = document.getElementById("emailError");
let passwordError = document.getElementById("passwordError");
let remember = document.getElementById("remember");


form.addEventListener("submit", function (e) {

    emailError.innerText = "";
    passwordError.innerText = "";

    let valid = true;

    if (email.value === "") {
        emailError.innerText = "Email is required";
        valid = false;
    }

    if (password.value === "") {
        passwordError.innerText = "Password is required";
        valid = false;
    }

    if (!valid) {
        e.preventDefault();
        return;
    }

    e.preventDefault();

    if (remember.checked) {
        localStorage.setItem("email", email.value);
    }

    window.location.href = "http://localhost/GreenNile-City/pages/register.php";

});


window.onload = function () {
    if (localStorage.getItem("email")) {
        email.value = localStorage.getItem("email");
    }
};