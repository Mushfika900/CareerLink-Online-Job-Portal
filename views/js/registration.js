document.addEventListener("DOMContentLoaded",function(){

let buttons=document.querySelectorAll(".account-type button");
let role=document.querySelector('input[name="role"]');

buttons.forEach(function(button){

button.addEventListener("click",function(){

buttons.forEach(function(btn){
    btn.classList.remove("active");
});

this.classList.add("active");

role.value=this.getAttribute("data-role");

console.log(role.value);

});

});

});