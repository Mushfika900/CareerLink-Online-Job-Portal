
    const password = document.getElementById("password");
    const showBtn = document.getElementById("showBtn");
    showBtn.addEventListener("click", function(){
 
    if(password.type === "password"){
        password.type = "text";
        showBtn.innerHTML = "Hide";
    }else{
        password.type = "password";
        showBtn.innerHTML = "Show";
    }
});


