import {renderCkeditor} from './ckeditor'
import {showMessage} from './message';
import {startLoading, stopLoading} from './loader';
import {renderTabs} from './tab';
import {renderLanguages} from './languageTab';
import {renderUploadImage} from './upload-image';
import {renderLocaleTags} from './tags';
import {renderGoogleBot} from './googlebot'
import {renderLocaleSeo} from './localeSeo'
import {renderSitemap} from './sitemap'
import {renderBlockParameters} from './blockParameters'
import {renderNestedSortables} from './sortable';
import {renderMenuItems} from './menuItems';
import {renderSelects} from './selects';

const table = document.getElementById("table");
const form = document.getElementById("form");
const refreshForm = document.getElementById('refresh-form');
let visibleSwitch = document.getElementById('visible');


if (refreshForm){

    refreshForm.addEventListener('click', (event) =>{

        event.preventDefault();
    
        let url = refreshForm.dataset.url;
    
        axios.get(url).then(response => {
            form.innerHTML = response.data.form;
            renderForm();
        });    
    })

}

export let renderForm = () => {

    let forms = document.querySelectorAll(".admin-form");
    let labels = document.getElementsByTagName('label');
    let inputs = document.querySelectorAll('.input');
    let enviar = document.getElementById("send");
    

    inputs.forEach(input => {

        input.addEventListener('focusin', () => {
    
            for( var i = 0; i < labels.length; i++ ) {
                if (labels[i].htmlFor == input.name){
                    labels[i].classList.add("active");
                }
            }
        });
    
        input.addEventListener('blur', () => {
    
            for( var i = 0; i < labels.length; i++ ) {
                labels[i].classList.remove("active");
            }
        });
    });

    if(visibleSwitch != null){

        visibleSwitch.addEventListener("click", () => {

            if(visibleSwitch.value == "true"){
                visibleSwitch.value = "false";
            }else{
                visibleSwitch.value = "true";
            }
        });
    }

    if (enviar){

        enviar.addEventListener("click", (event) => {

            event.preventDefault ()
        
            forms.forEach(form => { 
                            
                let data = new FormData(form);
    
                if( ckeditors != 'null'){
    
                    Object.entries(ckeditors).forEach(([key, value]) => {
                        data.append(key, value.getData());
                    });
                }
    
                let url = form.action;
        
                let sendPostRequest = async () => {
    
                    startLoading();
        
                    try {
                        await axios.post(url, data).then(response => {

                            if(response.data.id){
                                form.id.value = response.data.id;  
                            }

                            table.innerHTML = response.data.table;
    
                            showMessage('success', response.data.message);
                            renderTable();
                            stopLoading();
                           
                        });
                        
                    } catch (error) {
    
                        stopLoading();
        
                        if(error.response.status == '422'){
        
                            let errors = error.response.data.errors;      
                            let errorMessage = '';
        
                            Object.keys(errors).forEach(function(key) {
                                errorMessage += '<li>' + errors[key] + '</li>';
                            })
    
                            showMessage('error', errorMessage);
                        }
                    }
                };
        
                sendPostRequest();
            });
        });

    }
    
    renderCkeditor();
    renderTabs();
    renderLanguages();
    renderUploadImage();
    renderLocaleTags();
    renderLocaleSeo();
    renderGoogleBot();
    renderSitemap();
    renderBlockParameters();
    renderSelects();
    renderNestedSortables();
    renderMenuItems();
    
};


export let renderTable = () => {
    
    let editButtons= document.querySelectorAll(".edit");
    let removeButtons = document.querySelectorAll(".remove");
    let headerCells = document.querySelectorAll(".table-sortable th");
    let paginationButtons = document.querySelectorAll('.table-pagination-button');

    if(editButtons){

        editButtons.forEach(editButton => {

            editButton.addEventListener("click", () => {
    
                let url = editButton.dataset.url;
    
                let sendEditRequest = async () => {
    
                    try {
                        await axios.get(url).then(response => {
                            form.innerHTML = response.data.form;
                            renderForm();
                        });
                        
                    } catch (error) {
                        console.error(error);
                    }
                };
    
                sendEditRequest();
            });
        });

    }

    if(removeButtons){

        removeButtons.forEach(removeButton => {

            removeButton.addEventListener("click", () => {
    
                let url = removeButton.dataset.url;
    
                let sendDeleteRequest = async () => {
    
                    try {
                        await axios.delete(url).then(response => {
                            table.innerHTML = response.data.table;
                            renderTable();
                        });
                        
                    } catch (error) {
                        console.error(error);
                    }
                };
    
                sendDeleteRequest();
            });
        });

    }
    

    /**
     * Ordenar HTML Tabla   
     * 
     * @param {HTMLTableElement} table La tabla que ordenamos 
     * @param {number} column El index de la columna que ordenamos
     * @param {boolean} asc Determina la dirreccion del orden asc o dsc 
     */

    headerCells.forEach(headerCell => {

        headerCell.addEventListener("click", () =>{

            let table= headerCell.parentElement.parentElement.parentElement;
            let column = Array.prototype.indexOf.call(headerCell.parentElement.children, headerCell);
            let asc = !headerCell.classList.contains("th-sort-asc");

            let dirModifier = asc ? 1 : -1;
            let tBody = table.tBodies[0];
            let rows = Array.from(tBody.querySelectorAll('tr'));

            // Ordenar cada fila
            let sortedRows = rows.sort((a, b) =>{

                let aColText =a.querySelector(`td:nth-child(${column + 1})`).textContent.trim();
                let bColText =b.querySelector(`td:nth-child(${ column + 1})`).textContent.trim();

                return aColText > bColText ? (1 * dirModifier) : (-1 * dirModifier);
            });


            // Eliminar los tr que existan en la tabla 

            while(tBody.firstChild) {
                tBody.removeChild(tBody.firstChild);
            }

            // Vuelve a añadir la nueva fila ordenada
            tBody.append(...sortedRows);

            // Recordad como esta la columna ordenada
            table.querySelectorAll("th").forEach(th => th.classList.remove("th-sort-asc", "th-sort-desc"));
            table.querySelector(`th:nth-child(${ column + 1})`).classList.toggle("th-sort-asc", asc);
            table.querySelector(`th:nth-child(${ column + 1})`).classList.toggle("th-sort-desc", !asc);
        });
    });

    paginationButtons.forEach(paginationButton => {

        paginationButton.addEventListener("click", () => {
           

            let url = paginationButton.dataset.page;

            let sendPaginationRequest = async () => {

                try {
                    await axios.get(url).then(response => {
                        table.innerHTML = response.data.table;
                        renderTable();
                    });
                    
                } catch (error) {
                    console.error(error);
                }
            };

            sendPaginationRequest();
            
        });
    });
};

renderForm();
renderTable();
