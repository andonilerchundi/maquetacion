import {deleteThumbnail} from './upload-image';
import {stopLoading} from './loader';
import {showMessage} from './message'

let modalImageStoreButton = document.getElementById('modal-image-store-button');
let modalImageDeleteButton = document.getElementById('modal-image-delete-button');
let modalImageReturnButton = document.getElementById('modal-image-back-button');



modalImageReturnButton.addEventListener('click', () =>{

    let modal = document.getElementById('main-image');

    modal.classList.toggle('modal-image-active');
})


export let openModal = () => {

    let modal = document.getElementById('main-image');

    modal.classList.add('modal-active');
    
}

export let updateImageModal = (image) => {

    let imageContainer = document.getElementById('modal-image-original');
    let imageForm = document.getElementById('image-form');

    imageForm.reset();

    if(image.path){

        if(image.entity_id){
            image.imageId = image.id; 
            imageContainer.src = '../storage/' + image.path;
        }else{
            imageContainer.src = image.path;
        }

    }else{

        imageContainer.src = image.dataset.path;
        image = image.dataset;
    }
 
    for (var [key, val] of Object.entries(image)) {

        let input = imageForm.elements[key];
        
        if(input){

            switch(input.type) {
                case 'checkbox': input.checked = !!val; break;
                default:         input.value = val;     break;
            }
        }
    }
}

modalImageStoreButton.addEventListener("click", (e) => {
         
    let modal = document.getElementById('main-image');
    let imageForm = document.getElementById('image-form');
    let data = new FormData(imageForm);
    let url = imageForm.action;

    let sendImagePostRequest = async () => {

        try {
            axios.post(url, data).then(response => {

                modal.classList.remove('modal-active');
                imageForm.reset();
                stopLoading();
                showMessage('success', response.data.message);
              
            });
            
        } catch (error) {

        }
    };

    sendImagePostRequest();
});

modalImageDeleteButton.addEventListener("click", (e) => {
         
    let url = modalImageDeleteButton.dataset.route;
    let modal = document.getElementById('main-image');
    let imageForm = document.getElementById('image-form');
    let temporalId = document.getElementById('modal-image-temporal-id').value;
    let id = document.getElementById('modal-image-id').value;

    if(id){

        let sendImageDeleteRequest = async () => {

            try {
                
                axios.get(url, {
                    params: {
                      'image': id
                    }
                }).then(response => {
                    deleteThumbnail(response.data.imageId);
                    showMessage('success', response.data.message);
                });
                
            } catch (error) {
    
            }
        };
    
        sendImageDeleteRequest();

    }else{

        deleteThumbnail(temporalId);
    }

    modal.classList.remove('modal-active');
    imageForm.reset();
    stopLoading();
});
