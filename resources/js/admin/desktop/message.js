const messages = document.querySelectorAll('.message');

export let showMessage =(state, messageText) =>{


    messages.forEach(message => {
    
        
        if(message.classList.contains(state)){
    
            let successMessage = document.getElementById('message-description-'+ state);
    
            message.classList.add('popup');
            successMessage.innerHTML = messageText;
    
            setTimeout(function(){ 
                message.classList.remove('popup');
                message.classList.remove('message-popup');
            }, 3000); 
        };
       
    });


}
    
   