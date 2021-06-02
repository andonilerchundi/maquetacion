const linkProducts = document.querySelectorAll(".show-single-product");
const sidebar = document.getElementById("sidebar");
const sidebarButton = document.getElementById("sidebar-button");

linkProducts.forEach(linkProduct =>{

    linkProduct.addEventListener("click", () => {

        let url = linkProduct.dataset.url;

        let RefreshRequest = async () => {

            try {
                await axios.get(url).then(response => {
                    
                    view.innerHTML = response.data.view;
                    title.textContent = link.textContent;

                    sidebar.classList.remove("active");
                    sidebarButton.classList.remove('active');

                    window.history.pushState('','',url);

                });
                
            } catch (error) {
                console.error(error);
            }

            
        };

        RefreshRequest();
    });
});