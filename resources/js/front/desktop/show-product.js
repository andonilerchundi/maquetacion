const linkProducts = document.querySelectorAll(".show-single-product");
const sidebar = document.getElementById("sidebar");
const sidebarButton = document.getElementById("sidebar-button");
const container = document.getElementById('main-content');


linkProducts.forEach(linkProduct =>{

    linkProduct.addEventListener("click", () => {

        let url = linkProduct.dataset.url;

        let RefreshRequest = async () => {

            try {
                await axios.get(url).then(response => {
                    
                    container.innerHTML = response.data.product;

                
                    window.history.pushState('','',url);

                });
                
            } catch (error) {
                console.error(error);
            }

            
        };

        RefreshRequest();
    });
});













