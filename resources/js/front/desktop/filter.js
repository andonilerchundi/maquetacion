const frontButtonFilter = document.getElementById('front-button-filter');
const menuFilter = document.getElementById('filter-menu');
let buttonsSelected = document.querySelectorAll('.oz-button');
const applyFilter = document.getElementById('apply-filter-front');  


if (frontButtonFilter){

    frontButtonFilter.addEventListener('click', () =>{

    

        menuFilter.classList.toggle('menu-drop-down');

    });

}
    
if(buttonsSelected){

    buttonsSelected.forEach(buttonSelected => { 
    
        buttonSelected.addEventListener("click", (event) => {
    
            event.preventDefault();
    
            let selectedElements = document.querySelectorAll(".selected");
    
            selectedElements.forEach(selectedElements => {
                selectedElements.classList.remove("selected");
            });
            
            buttonSelected.classList.add("selected");
    
           
        });
    });
    
}


if(applyFilter){

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
                    console.log( response.data.table)
                
                    filter.classList.remove("menu-drop-down");
                    
                });
               
                
            } catch (error) {
    
            }
        }
        
        sendPostRequest();
        
    });

}