document.addEventListener("DOMContentLoaded", function () {
    const percentText = document.getElementById("percentage-text");
    const bar = document.querySelector(".custom-progress-bar");

    let progress = 0;

    const interval = setInterval(function () {
        progress++;

        bar.style.width = progress + "%";
        percentText.innerText = progress + "%";

        if (progress === 100) {
            clearInterval(interval);

            setTimeout(function () {
                window.location.href = "http://localhost/GreenNile-City/admin-pages/login.php";
            }, 3000);
        }
    }, 30); 
});