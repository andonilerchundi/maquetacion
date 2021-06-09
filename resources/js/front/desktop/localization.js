
import {renderSidebar} from './sidebar';
export let renderLocalization = () => {

    let modalLocalization = document.getElementById('modal-localization');
    let localization = document.getElementById('localization');
    let localizationOptions = document.querySelectorAll('.localization-option');

    if(localization){

        localization.addEventListener("click", (event) => {
    
            modalLocalization.classList.add('modal-active');
           
        });
    }

    if(localizationOptions){

        localizationOptions.forEach(localizationOption => {

            localizationOption.addEventListener("click", (event) => {

                let url = localizationOption.dataset.route;
            
                let sendLocalizationRequest = async () => {

                    try {

                        axios.get(url).then(response => {
                            modalLocalization.classList.remove('modal-active');
                           
                        });
                        
                    } catch (error) {
            
                    }
                };
        
                sendLocalizationRequest();
            });
            
        });
    }
}

renderLocalization();
renderSidebar();
