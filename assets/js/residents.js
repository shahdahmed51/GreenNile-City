const searchInput = document.getElementById("searchInput");
const table = document.getElementById("residentTable");
const rows = table.querySelectorAll("tbody tr");

searchInput.addEventListener("keyup", function () {

    let value = this.value.toLowerCase();

    rows.forEach(function (row) {

        let text = row.innerText.toLowerCase();

        if (text.includes(value)) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }

    });

});
const statusFilter = document.getElementById("statusFilter");

statusFilter.addEventListener("change", function () {

    let selectedStatus = this.value;

    rows.forEach(function (row) {

        let status = row.querySelector(".status").innerText.toLowerCase();

        if (selectedStatus === "all" || status === selectedStatus) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }

    });

});