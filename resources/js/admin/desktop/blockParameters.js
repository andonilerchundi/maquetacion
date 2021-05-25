export let renderBlockParameters =()=>{


    let blockParameters = document.querySelectorAll('.block-parameters');
    
    if(blockParameters){


        blockParameters.forEach(blockParameter =>{

            blockParameter.addEventListener ('keydown', ()=>{

                let slug = blockParameter.value.match(/\{.*?\}/g);
            })

            blockParameter.addEventListener ('keyup', ()=>{

                let slug = blockParameter.value.match(/\{.*?\}/g);

            })
        })
    }




}