document.querySelector(".btn-collect").addEventListener('click',() =>{
    document.querySelector(".sub-collection").classList.toggle("change");
    
});

document.querySelector(".btn-price").addEventListener('click',() =>{
  document.querySelector(".sub-price").classList.toggle("change");
  
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

  