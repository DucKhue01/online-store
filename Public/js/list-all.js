document.querySelector(".fas").addEventListener('click',() =>{
    document.querySelector(".sub").classList.toggle("change");
    
});
    


//     document.querySelector(".btn").addEventListener('click',(e) =>{

      
// })

document.querySelectorAll('.btn').forEach(item => {
    item.addEventListener('click', e => {
      //handle click
      if (e.target.classList.contains("fa-plus")) {
        e.target.classList.remove("fa-plus");
        e.target.classList.toggle("fa-minus");
    }else{
        e.target.classList.remove("fa-minus");
        e.target.classList.toggle("fa-plus");
    }       
    })
  })
