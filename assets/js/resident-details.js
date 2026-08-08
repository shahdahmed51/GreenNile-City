const deleteBtn=document.getElementById("deleteResident");
deleteBtn.addEventListener("click",function(){
const confimDelete = confirm(
    "Are you sure you want to delete this resident?"
);
if(confimDelete){
    alert("Resident is deleted successfully! ");
    window.location.href="resident.php";
}
});