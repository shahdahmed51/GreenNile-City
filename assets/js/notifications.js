let markread=document.getElementById("markread");
let notifications=document.querySelectorAll(".notification-card");
let tabs=document.querySelectorAll(".notification-tabs button");
//mark all as read
markread.addEventListener("click",function(e){
    e.preventDefault();
    notifications.forEach(function(card){
        card.classList.remove("unread");
    });
});
//tabs
tabs.forEach(function(tab){
    tab.addEventListener("click",function(){
        tabs.forEach(function(btn){
            btn.classList.remove("active");
        });
        tab.classList.add("active");
        let selectedTab=tab.textContent.trim();
        notifications.forEach(function(card){
            console.log(selectedTab);
            if(selectedTab ==="All"){
                card.style.display="flex";
            }
            else if(selectedTab ==="Unread"){
                if(card.classList.contains("unread")){
                    card.style.display="flax";
                }else{
                    card.style.display="none";
                }
            }
            else if(selectedTab ==="Read"){
                if(card.classList.contains("unread")){
                    card.style.display="none";
                }else{
                    card.style.display="flex";
                }
            }
        });
    });
});