
export let renderSidebar = () => {

    const menuLink = document.querySelectorAll('.menulink')
    const sidebar = document.getElementById("sidebar");
    const sidebarButton = document.getElementById("sidebar-button");

    if(sidebarButton){

        sidebarButton.addEventListener('click', () =>{
        
            sidebarButton.classList.toggle("active");
            sidebar.classList.toggle("active"); 
        
        });
    }

 
   
}
