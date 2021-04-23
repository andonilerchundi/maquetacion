const bottombarItems = document.querySelectorAll('.bottombar-item');
const table = document.getElementById("table");
const form = document.getElementById("form");


bottombarItems.forEach( bottombarItem => {

    bottombarItem.addEventListener("click", () => {

        let visibleElements = document.querySelectorAll(".bottombar-visible");

        visibleElements.forEach(visibleElement => {
            visibleElement.classList.remove("bottombar-visible");
        });
                
        bottombarItem.classList.add('bottombar-visible');

        if(bottombarItem.dataset.option == 'form'){
            showForm();
        }

        if(bottombarItem.dataset.option == 'table'){
            showTable(bottombarItem.dataset.url);
        }
    });
});

let showForm = () => {
    form.classList.add('visible');
    table.classList.remove('visible');
    hideFilterTable();
};

let showTable = (url) => {

    let sendShowRequest = async () => {

        try {
            await axios.get(url).then(response => {
                table.innerHTML = response.data.table;
                renderTable();
            });
            
        } catch (error) {
            console.error(error);
        }
    };

    sendShowRequest();

    table.classList.add('visible');
    form.classList.remove('visible');
    showFilterTable();
};
