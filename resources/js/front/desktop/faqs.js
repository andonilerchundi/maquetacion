
export let renderFaqs = () => {

    const faqButtons = document.querySelectorAll(".faq-button")
    const faqElements = document.querySelectorAll(".faq-description");
    
    faqButtons.forEach(faqButton => { 
    
        faqButton.addEventListener("click", () => {
    
            let activeElements = document.querySelectorAll(".active");
    
            if(faqButton.classList.contains("active")){
    
                faqButton.classList.remove("active");
    
                activeElements.forEach(activeElement => {
                    activeElement.classList.remove("active");
                });
    
            }else{
    
                activeElements.forEach(activeElement => {
                    activeElement.classList.remove("active");
                });
                
                faqButton.classList.add("active");
    
                faqElements.forEach(faq => {
    
                    if(faq.dataset.content == faqButton.dataset.button){
                        faq.classList.add("active"); 
                    }else{
                    }
                });
            }
        });
        
    });
    


    
}

