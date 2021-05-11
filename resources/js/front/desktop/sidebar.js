const links = document.querySelectorAll(".link");
const sidebar = document.getElementById("sidebar");
const sidebarButton = document.getElementById("sidebar-button");


sidebarButton.addEventListener('click', () =>{
    
    sidebarButton.classList.toggle("active");
    sidebar.classList.toggle("active"); 

});