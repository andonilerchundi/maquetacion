
import {showMessage} from './message';


export let renderGoogleBot = () => {

    let pingGoogle = document.getElementById('ping-google');

    if(pingGoogle){

        pingGoogle.addEventListener("click", () => {

            let url = pingGoogle.dataset.url;
        
            let sendEditRequest = async () => {
    
                try {
                    await axios.get(url).then(response => {
                        showMessage('success', response.data.message);
                    });
                    
                } catch (error) {
                    console.error(error);
                }
            };
    
            sendEditRequest();
        });
    }
}
