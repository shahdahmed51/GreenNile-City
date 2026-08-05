form.addEventListener("submit", function () {
    emailError.innerText = "";
    passwordError.innerText = "";
    if (remember.checked) {
        localStorage.setItem("email", email.value);
    }
    else{
        localStorage.removeItem("email");
    }

});
