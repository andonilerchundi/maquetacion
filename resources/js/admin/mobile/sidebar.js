import {renderForm, renderTable} from './form-table.js'

const { default: axios } = require("axios");
const table = document.getElementById("table");
const form = document.getElementById("form");
const links = document.querySelectorAll(".link");
const sidebar = document.getElementById("sidebar");
const sidebarButton = document.getElementById("sidebar-button");
const title = document.getElementById('title-page');





links.forEach(link =>{

    link.addEventListener("click", () => {

        let url = link.dataset.url;

        let RefreshRequest = async () => {

            try {
                await axios.get(url).then(response => {
                    form.innerHTML = response.data.form;
                    table.innerHTML = response.data.table;
                    title.textContent = link.textContent;

                    sidebar.classList.remove("active");
                    sidebarButton.classList.remove('active');

                    window.history.pushState('','',url);

                    renderForm();
                    renderTable();

                });
                
            } catch (error) {
                console.error(error);
            }

            
        };

        RefreshRequest();
    });
});

sidebarButton.addEventListener('click', () =>{
    
    sidebarButton.classList.toggle("active");
    sidebar.classList.toggle("active"); 

});