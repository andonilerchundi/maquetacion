

let modalImageStoreButton = document.getElementById('modal-image-store-button');
let modalImageDeleteButton = document.getElementById('modal-image-delete-button');
let modalImageReturnButton = document.getElementById('modal-image-back-button');



modalImageReturnButton.addEventListener('click', () =>{

    let modal = document.getElementById('main-image');

    modal.classList.toggle('modal-active');
})


export let openModal = () => {

    let modal = document.getElementById('main-image');

    modal.classList.add('modal-active');
  
   
}

export let openImageModal = (image) => {

    let modal = document.getElementById('main-image');
    let imageContainer = document.getElementById('modal-image-original');
    let imageForm = document.getElementById('image-form');

    if(image.path){
        imageContainer.src = '../storage/' + image.path;
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

    modal.classList.add('modal-active');
    

}

export let updateImageModal = (image) => {

    let imageContainer = document.getElementById('modal-image-original');

    imageContainer.src = image;
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
                
              
              
            });
            
        } catch (error) {

        }
    };

    sendImagePostRequest();
});

modalImageDeleteButton.addEventListener("click", (e) => {
         
    let modal = document.getElementById('main-image');
    let url = modalImageDeleteButton.dataset.route;
    let imageId = document.getElementById('modal-image-id').value;

    let sendImageDeleteRequest = async () => {

        try {
            axios.get(url, {
                params: {
                  'image': imageId
                }
            }).then(response => {

                modal.classList.remove('modal-active');
              
               

                let uploadImages = document.querySelectorAll(".upload");

                uploadImages.forEach(uploadImage => {

                    if(uploadImage.classList.contains(imageId)){

                        uploadImage.remove();
                    }
                
                });
        
            });
            
        } catch (error) {

        }
    };

    sendImageDeleteRequest();
});

