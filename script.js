//Header script
const menuToggle = document.getElementById("menuToggle");
const mobileMenu = document.getElementById("mobileMenu");

menuToggle.addEventListener("click", () => {

    mobileMenu.style.display = mobileMenu.style.display === "block" ? "none" : "block";
    
});

//Login form switch
function switchForm (formId) {

    document.querySelectorAll(".container").forEach(form => form.classList.remove("active"));

    document.getElementById(formId).classList.add("active");
    
}

//Password toggle icon
const registerPassword = document.querySelector("registerPassword");
const registerPasswordToggle = document.querySelector("registerPasswordToggle");

if (registerPasswordToggle){

    registerPasswordToggle.addEventListener("click", function () {

        passwordReveal(registerPassword, this);

    });

}


const loginPassword = document.querySelector("loginPassword");
const loginPasswordToggle = document.querySelector("loginPasswordToggle");

if (loginPasswordToggle){

    loginPasswordToggle.addEventListener("click", function () {

        passwordReveal(loginPassword, this);

    });

}

function passwordReveal(input, toggleBtn) {

    if(input.type === "password") {

        input.type = "text";


    } else{

        input.type = "password";

        
    }

};

const form = document.querySelector("form");

form.addEventListener('submit', function (e) {

    e.preventDefault();

})





// Login conditions
function validateForm(){
    //Getting the values
let username=document.getElementById("username").value.trim();
let email=document.getElementById("email").value.trim();
let password=document.getElementById("password").value.trim();
 
//Get error messages
let userNameError =document.getElementById("userNameError");
let emailError =document.getElementById("emailError");
let passwordError =document.getElementById("passwordError");
 
//clear Errors
userNameError.innerHTML="";
emailError.innerHTML="";
passwordError.innerHTML="";
let isValid=true;
if(username===""){
    userNameError.innerHTML="Username is required";
    isValid=false;
}
let emailPattern=/^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
if(email===""){
    emailError.innerHTML="Email is required";
    isValid=false;
}else if(!email.match(emailPattern)){
    emailError.innerHTML="invalid email format";
    isValid=false;
}
 
if(password===""){
    passwordError.innerHTML="Password is required";
    isValid=false;
}else if(password.length<6){
    passwordError.innerHTML="Password must be at least 6 characters long";
    isValid=false;
}
 
return isValid;
}
 
// Function for login form validation
function validateLoginForm() {
    //Getting the values
    let email=document.getElementById("email").value.trim();
    let password=document.getElementById("password").value.trim();
 
    //Get error messages
    let emailError =document.getElementById("emailError");
    let passwordError =document.getElementById("passwordError");
 
    //clear Errors
    emailError.innerHTML="";
    passwordError.innerHTML="";
    let isValid=true;
   
    if(email===""){
        userNameError.innerHTML="Email address is required";
        isValid=false;
    }
 
    if(password===""){
        passwordError.innerHTML="Password is required";
        isValid=false;
    }
 
    return isValid;
}



