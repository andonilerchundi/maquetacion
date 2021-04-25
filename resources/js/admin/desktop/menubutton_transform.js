const menuBtn = document.querySelectorAll('.menu-btn');
let menuOpen = false;
menuOpen.addEventListener('click', () =>{
    if(!menuOpen){
        menuBtn.classList.add('active');
        menuOpen = true;
    }else{
        menuBtn.classList.remove('active')
        menuOpen=false;
    }
});