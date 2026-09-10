
 function showPassword(){
    const password = document.getElementById("password");
    const button = document.getElementById("showBtn");
 
    if(password.type === "password"){
        password.type = "text";
        button.innerHTML = "Hide";
    }else{
        password.type = "password";
        button.innerHTML = "Show";
    }
}

const form = document.getElementById("loginForm");

form.addEventListener("submit", function(event){

    

    const email = document.getElementById("email");
    const password = document.getElementById("password");

    const emailError = document.getElementById("emailError");
    const passError = document.getElementById("passError");

    emailError.innerHTML = "";
    passError.innerHTML = "";

    if(email.value == ""){
        event.preventDefault();

        emailError.innerHTML = "Email is required";
       
    }else if(!email.checkValidity()){
        event.preventDefault();

        emailError.innerHTML = "Please enter a valid email";
        

    }else if(password.value == ""){
        event.preventDefault();

        passError.innerHTML = "Password is required";
        
    }else if(password.value.length < 8){
        event.preventDefault();

        passError.innerHTML = "Password must be at least 8 characters";
        
    }

});
  
