export let tabsItemsLanguage = document.querySelectorAll(".tab-item-language");
export let tabPanelsLanguage = document.querySelectorAll(".tab-panel-language");

tabsItemsLanguage.forEach(tabItemLanguage => { 

    tabItemLanguage.addEventListener("click", () => {

        let activeElements = document.querySelectorAll(".language-active");

        activeElements.forEach(activeElement => {
            activeElement.classList.remove("language-active");
        });
        
        tabItemLanguage.classList.add("language-active");

        tabPanelsLanguage.forEach(tabPanelLanguage => {

            if(tabPanelLanguage.dataset.tab == tabItemLanguage.dataset.tab){
                tabPanelLanguage.classList.add("language-active"); 
            }
        });
    });

   
});