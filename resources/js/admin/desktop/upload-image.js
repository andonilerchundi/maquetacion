import { showMessage } from './message';
import {openModal, updateImageModal} from './modal-image'

export let renderUploadImage = () => {

    let inputElements = document.querySelectorAll(".upload-input");
    let uploadImages = document.querySelectorAll(".upload");

    inputElements.forEach(inputElement => {
    
        uploadImage(inputElement);
    });

    uploadImages.forEach(uploadImage => {

        uploadImage.addEventListener("click", (e) => {

            openImage(uploadImage);
        });
    });
}

function uploadImage(inputElement){

    let uploadElement = inputElement.parentElement;

    uploadElement.addEventListener("click", (e) => {
        
        let thumbnailElement = uploadElement.querySelector(".upload-thumb");

        if(!thumbnailElement){
            inputElement.click();
        }else{
            openImage(uploadElement);
        };
    });
  
    inputElement.addEventListener("change", (e) => {
        if (inputElement.files.length) {
            updateThumbnail(uploadElement, inputElement.files[0]);
        }
    });
  
    uploadElement.addEventListener("dragover", (e) => {
        e.preventDefault();
        uploadElement.classList.add("upload-over");
    });
  
    ["dragleave", "dragend"].forEach((type) => {
        uploadElement.addEventListener(type, (e) => {
            uploadElement.classList.remove("upload-over");
        });
    });
  
    uploadElement.addEventListener("drop", (e) => {
        e.preventDefault();
    
        if (e.dataTransfer.files.length) {
            inputElement.files = e.dataTransfer.files;
            updateThumbnail(uploadElement, e.dataTransfer.files[0]);
        }
    
        uploadElement.classList.remove("upload-over");
    });
}
  
function updateThumbnail(uploadElement, file) {
            
    if (file.type.startsWith("image/")) {

        let thumbnailElement = uploadElement.querySelector(".upload-thumb");

        if(uploadElement.classList.contains('collection')){

            if(!thumbnailElement){

                let cloneUploadElement = uploadElement.cloneNode(true);
                let cloneInput = cloneUploadElement.querySelector('.upload-input');

                uploadImage(cloneInput);
                uploadElement.parentElement.insertBefore(cloneUploadElement,uploadElement);
            }
        }
    
        if (uploadElement.querySelector(".upload-prompt")) {
            uploadElement.querySelector(".upload-prompt").classList.add('hidden');
        }
        
        if (!thumbnailElement) {
            thumbnailElement = document.createElement("div");
            thumbnailElement.classList.add("upload-thumb");
            uploadElement.appendChild(thumbnailElement);
        }

        let reader = new FileReader();

        reader.readAsDataURL(file);
        
        reader.onload = () => {

            let temporalId = Math.floor((Math.random() * 99999) + 1);
            let content = uploadElement.dataset.content;
            let language = uploadElement.dataset.language;

            let inputElement = uploadElement.getElementsByClassName("upload-input")[0];

            thumbnailElement.style.backgroundImage = `url('${reader.result}')`;
            uploadElement.dataset.temporalId = temporalId;
            uploadElement.dataset.path = reader.result;
            inputElement.name = "images[" + content + "-" + temporalId + "." + language  + "]"; 

            uploadElement.classList.remove('upload-image-add');
            uploadElement.classList.add('upload');

            updateImageModal(uploadElement);
            openModal();
        };
        
    }else{
        thumbnailElement.style.backgroundImage = null;
    }
}

function openImage(image){

    let temporalId = image.dataset.temporalId;
    let url = image.dataset.url;

    if(temporalId){

        let sendImageRequest = async () => {

            try {
                axios.get(url, {
                    params: {
                      'image': temporalId
                    }
                }).then(response => {
                        
                    if(response.data){  
                        response.data.path = image.dataset.path;
                        updateImageModal(response.data);
                    }else{
                        updateImageModal(image);
                    };

                    openModal();
                    
                });
                
            } catch (error) {

                showMessage()
    
            }
        };

        sendImageRequest();

    }else{       
        
        let sendImageRequest = async () => {

            try {
                axios.get(url).then(response => {
    
                    response.data.path = response.data.original_image.path;
                    updateImageModal(response.data);
                    openModal();
                    
                });
                
            } catch (error) {
    
            }
        };

        sendImageRequest();
    }
}

export function deleteThumbnail(imageId) {

    let uploadImages = document.querySelectorAll(".upload");

    uploadImages.forEach(uploadImage => {
    
        if(uploadImage.classList.contains('collection')){

            if(uploadImage.dataset.temporalId == imageId || uploadImage.dataset.imageId == imageId){

                uploadImage.remove();
            }

            
        }

        if(uploadImage.classList.contains('single')){

            if(uploadImage.dataset.temporalId == imageId || uploadImage.dataset.imageId == imageId){

                uploadImage.querySelector(".upload-thumb").remove();
                uploadImage.dataset.temporalId == '';
                uploadImage.querySelector(".upload-prompt").classList.remove('hidden');
                uploadImage.classList.remove('upload');
                uploadImage.classList.add('upload-image-add');

                if(uploadImage.querySelector(".upload-input")){
                    uploadImage.querySelector(".upload-input").value = "";
                }
            }
        }
    });
}
