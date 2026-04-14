let switchCtn = document.querySelector("#switch-cnt");
let switchC1 = document.querySelector("#switch-c1");
let switchC2 = document.querySelector("#switch-c2");
let switchCircle = document.querySelectorAll(".switch__circle");
let switchBtn = document.querySelectorAll(".switch-btn");
let aContainer = document.querySelector("#a-container");
let bContainer = document.querySelector("#b-container");
let allButtons = document.querySelectorAll(".submit");

let getButtons = (e) => e.preventDefault()

let changeForm = (e) => {

    switchCtn.classList.add("is-gx");
    setTimeout(function(){
        switchCtn.classList.remove("is-gx");
    }, 1500)

    switchCtn.classList.toggle("is-txr");
    switchCircle[0].classList.toggle("is-txr");
    switchCircle[1].classList.toggle("is-txr");

    switchC1.classList.toggle("is-hidden");
    switchC2.classList.toggle("is-hidden");
    aContainer.classList.toggle("is-txl");
    bContainer.classList.toggle("is-txl");
    bContainer.classList.toggle("is-z200");
}


let mainF = (e) => {
    
    for (var i = 0; i < allButtons.length; i++)
        allButtons[i].addEventListener("click", getButtons);
    for (var i = 0; i < switchBtn.length; i++)
        switchBtn[i].addEventListener("click", changeForm);
}

document.addEventListener("DOMContentLoaded", function () {
    let allButtons = document.querySelectorAll(".submit");

    for (let i = 0; i < allButtons.length; i++) {
        allButtons[i].addEventListener("click", function (e) {
            e.preventDefault();
        });
    }

    let switchBtn = document.querySelectorAll(".switch"); 

    window.addEventListener("load", mainF);
});

document.addEventListener("DOMContentLoaded", function () {
    const switchButton = document.querySelector(".switch-btn");
    const container1 = document.getElementById("switch-c1");
    const container2 = document.getElementById("switch-c2");
  
    switchButton.addEventListener("click", function () {
      container1.classList.toggle("is-hidden");
      container2.classList.toggle("is-hidden");
    });
  });

document.addEventListener("DOMContentLoaded", function () {
    const loadingOverlay = document.getElementById("loading-overlay");
    const forms = document.querySelectorAll(".form");
  
    forms.forEach(function (form) {
      form.addEventListener("submit", function () {
        loadingOverlay.style.display = "block";
  
        setTimeout(function () {
          
          loadingOverlay.style.display = "none";
        }, 2000);
      });
    });
  });

