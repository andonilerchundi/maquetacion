import {renderForm, renderTable} from './form-table.js'

const { default: axios } = require("axios");
const table = document.getElementById("table");
const form = document.getElementById("form");
const links = document.querySelectorAll(".link");
const sidebar = document.querySelectorAll(".sidebar");
const sidebarButton = document.querySelectorAll(".sidebar-button");
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

sidebarButton.forEach(sidebarButton => { 

    sidebarButton.addEventListener("click", () => {

        let activeElements = document.querySelectorAll(".active");

        if(sidebarButton.classList.contains("active")){

            sidebarButton.classList.remove("active");

            activeElements.forEach(activeElement => {
                activeElement.classList.remove("active");
            });

        }else{

            activeElements.forEach(activeElement => {
                activeElement.classList.remove("active");
            });
            
            sidebarButton.classList.add("active");

            sidebar.forEach(sidebar => {

                if(sidebar.dataset.content == sidebarButton.dataset.button){
                    sidebar.classList.add("active"); 
                }else{
                }
            });
        }
    });

});


