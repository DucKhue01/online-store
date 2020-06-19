const signIn = document.querySelector("#signInButton");
const signUp = document.querySelector("#signUpButton");
const signInForm = document.querySelector(".container-login .sign-in-form");
const signUpForm = document.querySelector(".container-login .sign-up-form");
const overlay_container = document.querySelector(
".container-login .overlay-container-login"
);
const overlay = document.querySelector(
".container-login .overlay-container-login .overlay"
);

signIn.addEventListener("click", () => {
overlay_container.style.transform = "translateX(100%)";
overlay.style.transform = "translateX(-50%)";
signInForm.classList.add("active");
signUpForm.classList.remove("active");
});
signUp.addEventListener("click", () => {
overlay_container.style.transform = "translateX(0)";
overlay.style.transform = "translateX(0)";
signUpForm.classList.add("active");
signInForm.classList.remove("active");
});


document.querySelector("#exit").addEventListener('click',() =>{
    document.querySelector(".container01").classList.add("change");
    
    })