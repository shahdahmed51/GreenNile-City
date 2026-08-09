const tabs = document.querySelectorAll(".announcement-tab");
const announcements = document.querySelectorAll(".announcement-item");

tabs.forEach(function (tab) {

    tab.addEventListener("click", function () {

        tabs.forEach(function (item) {
            item.classList.remove("active");
        });

        this.classList.add("active");

        const category = this.dataset.category;

        announcements.forEach(function (announcement) {

            if (
                category === "all" ||
                announcement.dataset.category === category
            ) {
                announcement.style.display = "flex";
            } else {
                announcement.style.display = "none";
            }

        });

    });

});