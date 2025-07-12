const changebutton=document.getElementById("change");
const changeinfo=document.querySelector(".update_information");

changebutton.addEventListener("click",(e)=>{
    e.stopPropagation();
    changeinfo.classList.add("active");

})

const close=document.getElementById('close');
close.addEventListener("click",(e)=>{
    e.stopPropagation();
    changeinfo.classList.remove("active");

})

document.addEventListener("click", (e) => {
    if (!changeinfo.contains(e.target) && e.target !== changebutton) {
      changeinfo.classList.remove("active");
    }
  });
  