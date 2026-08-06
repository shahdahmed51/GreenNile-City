const searchInput=document.getElementById("searchInput");
const rows=document.querySelectorAll("tbody tr");
searchInput.addEventListener("input",function(){
    let value=this.value.toLowerCase().trim();
    rows.forEach(function(row){
        let text=row.innerText.toLowerCase();
        if(text.includes(value)){
            row.style.display="";
        }
        else{
            row.style.display="none";
        }
    });
});

const statusFilter = document.getElementById("statusFilter");
statusFilter.addEventListener("change", function () {
    let selected = this.value.toLowerCase().trim();
    rows.forEach(function (row) {
        let status = row.children[4].innerText.toLowerCase().trim();
        if (selected === "all") {
            row.style.display = "";
        }
         else {
            if (status === selected) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        }
    });
});
