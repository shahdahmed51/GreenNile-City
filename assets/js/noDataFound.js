const button = document.getElementById("noDataBtn");

if (button) {

    button.addEventListener("click", function () {

        if (history.length > 1) {
            history.back();
        } else {
            window.location.href = "/GREENNILE-CITY/pages/login.php";
        }

    });

}