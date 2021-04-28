const dots = document.getElementById('loader-container');


export let startLoading = () => {
    dots.classList.add('loading');
   
}

export let stopLoading = () => {
    dots.classList.remove('loading');
    
}