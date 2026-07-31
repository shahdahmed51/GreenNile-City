let form=document.getElementById("loginForm");
form.addEventListener("submit",function(e){

    emailError.innerText="";
    passwordError.innerText="";

    let valid=true;

    if(email.value===""){
        emailError.innerText="Email is required";
        valid=false;
    }
    if(password.value===""){
        passwordError.innerText="Password is required";
        valid=false;
    }
    if(!valid){
        e.preventDefault();
    }

});
let email=document.getElementById("email");
let password=document.getElementById("password");
let emailError=document.getElementById("emailError");
let passwordError=document.getElementById("passwordError");
let remember=document.getElementById("remember");
form.addEventListener("submit",function(e){
    if(email.value!==""&&password.value!==""){
        if(remember.checked){
            localStorage.setItem("email",email.value);
        }
        alert("Login successful");
    }
});
window.onload=function(){
    if(localStorage.getItem("email")){
        email.value=localStorage.getItem("email");
    }
}
let btn = document.getElementById("loginBtn");