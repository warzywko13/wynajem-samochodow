//pobranie paneli
const login_panel = document.querySelector("#login-panel");
const register_panel = document.querySelector("#register-panel");

//pobranie przycisków
const login_button = document.querySelector("#login");
const register_button = document.querySelector("#register");
    
//pokazuje i ukrywa panel logwania i rejestrowania
const showHide = () => {
   login_panel.classList.toggle("hidden");
   register_panel.classList.toggle("hidden");
}

//wywołuje funkcje
login_button.addEventListener("click", showHide);
register_button.addEventListener("click", showHide);