
    const password = document.getElementById("password");
    const showPass = document.getElementById("showPass");
    showPass.addEventListener("click", function(){
    if(password.type === "password"){
        password.type = "text";
        showPass.innerHTML = "Hide";
    }else{
        password.type = "password";
        showPass.innerHTML = "Show";
    }
});

const jobSeekerBtn=document.querySelector(".btn_jobseeker");
const employerBtn=document.querySelector(".btn_employer");
const role=document.getElementById("role");

jobSeekerBtn.addEventListener("click",function(){
    role.value="jobseeker";
    jobSeekerBtn.classList.add("active");
    employerBtn.classList.remove("active");
});

employerBtn.addEventListener("click",function(){
    role.value="employer";
    employerBtn.classList.add("active");
    jobSeekerBtn.classList.remove("active");
});

