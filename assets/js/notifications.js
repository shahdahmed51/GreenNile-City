let markread=document.getElementById("markread");
let notifications=document.querySelectorAll(".notification-card");
markread.addEventListener("click",function(e){
    e.preventDefault();
    notifications.forEach(function(card){
        card.classList.remove("unread");
    });
});