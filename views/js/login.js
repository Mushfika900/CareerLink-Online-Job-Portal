function showPassword(){

    const password = document.getElementById("pass");
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

    event.preventDefault();

    const email = document.getElementById("email");
    const password = document.getElementById("pass");

    const emailError = document.getElementById("emailError");
    const passError = document.getElementById("passError");

    emailError.innerHTML = "";
    passError.innerHTML = "";

    if(email.value == ""){

        emailError.innerHTML = "Email is required";
        emailError.style.color = "red";

    }else if(!email.checkValidity()){

        emailError.innerHTML = "Please enter a valid email";
        emailError.style.color = "red";

    }else if(password.value == ""){

        passError.innerHTML = "Password is required";
        passError.style.color = "red";

    }else if(password.value.length < 8){

        passError.innerHTML = "Password must be at least 8 characters";
        passError.style.color = "red";

    }else{

        alert("Login form is valid");

    }

});