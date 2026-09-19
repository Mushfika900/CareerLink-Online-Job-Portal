
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


function showNewPassword(){
    const newPass=document.getElementById("newPass");
    const btn=document.getElementById("new-pass");

    if(newPass.type==="password"){
        newPass.type="text";
        btn.innerHTML="Hide";
    }else{
        newPass.type="password";
        btn.innerHTML="Show";
    }
}

function showConfirmPassword(){
    const confirmPass=document.getElementById("confirmPass");
    const btn=document.getElementById("confirm-pass");

    if(confirmPass.type==="password"){
        confirmPass.type="text";
        btn.innerHTML="Hide";
    }else{
        confirmPass.type="password";
        btn.innerHTML="Show";
    }
}




