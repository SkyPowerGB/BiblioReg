document.addEventListener('DOMContentLoaded', () => {

    const showCollapsedbarBtn = document.getElementById("showCollapsedNavbar");
    const collapsedNavbar = document.getElementById("collapsedNavbar");

    showCollapsedbarBtn.addEventListener('click', () => {
        if (collapsedNavbar.classList.contains("nav-bar-hide")) {
            collapsedNavbar.classList.remove("nav-bar-hide");
        } else {
            collapsedNavbar.classList.add("nav-bar-hide");
        }


    });
   

   const showAccountOptions =document.getElementById("showAccountOptions");
const accountOptionsBar=document.getElementById("accountOptionsBar");

   showAccountOptions.addEventListener('click', () => {
        if (accountOptionsBar.classList.contains("nav-bar-hide")) {
            accountOptionsBar.classList.remove("nav-bar-hide");
        } else {
            accountOptionsBar.classList.add("nav-bar-hide");
        }


    });

});