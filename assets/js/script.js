document.addEventListener("DOMContentLoaded", function() {
    const percentText = document.getElementById('percentage-text');
    const bar = document.querySelector('.custom-progress-bar');
    let completed = 10; // اللي خلصه
    let total = 10;    // كل الدروس

    let progress = (completed / total) * 100;


    bar.style.width = progress + "%";
    percentText.innerText = progress + "%";
});