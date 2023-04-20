// BODY DARK/LIGHT THEME ALTERNATE //

const btn = document.getElementById("theme");
const userIcone = document.getElementById("usericon");
const homeButton = document.getElementById("homebutton")

btn.addEventListener("click", function () {
  if(homeButton.classList.contains("text-white")){
    homeButton.classList.remove("text-white")
    homeButton.classList.add("text-dark")
    document.body.classList.toggle("alternate");
    userIcone.style.border = "1px solid #332d2d";
  } else if(homeButton.classList.contains("text-dark")) {
    homeButton.classList.remove("text-dark")
    homeButton.classList.add("text-white")
    document.body.classList.toggle("alternate");
  }
});
