export let renderLanguages = () =>{

    let tabsItemsLanguage = document.querySelectorAll(".tab-item-language");
    let tabPanelsLanguage = document.querySelectorAll(".tab-panel-language");
    
    tabsItemsLanguage.forEach(tabItemLanguage => { 
    
        tabItemLanguage.addEventListener("click", () => {
    
            let activeElements = document.querySelectorAll(".language-active");
            let activeTab = tabItemLanguage.dataset.tab;
            
            activeElements.forEach(activeElement => {

                if(activeElement.dataset.tab == activeTab){
                    
                    activeElement.classList.remove("language-active");
                }
                
            });
            
            tabItemLanguage.classList.add("language-active");
    
            tabPanelsLanguage.forEach(tabPanelLanguage => {
    
                if(tabPanelLanguage.dataset.tab == activeTab){

                    if(tabPanelLanguage.dataset.localetab == tabItemLanguage.dataset.localetab){
                        tabPanelLanguage.classList.add("language-active"); 
                    }
                } 
                        
            });
        });
    
       
    });

}



