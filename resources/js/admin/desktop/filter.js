import {renderTable} from './form-table';

const buttonFilter = document.getElementById('filter-button');
const filter = document.getElementById("filter");
const filterForm = document.getElementById("filter-form");
const applyFilter = document.getElementById('apply-filter');

buttonFilter.addEventListener("click", () => {

    filter.classList.toggle('appear');
});

applyFilter .addEventListener( 'click', () => {   
    
    let data = new FormData(filterForm);
    let filters = {};

    data.forEach(function(value, key){
        filters[key] = value;
    });

    let json = JSON.stringify(filters);

    let url = filterForm.action;

    let sendPostRequest = async () => {

        try {
            axios.get(url, {
                params: {
                  filters: json
                }
            }).then(response => {
               
                table.innerHTML = response.data.table;
                renderTable();

                filter.classList.remove("appear");
            });
           
            
        } catch (error) {

        }
    }
    
    sendPostRequest();
    
});

