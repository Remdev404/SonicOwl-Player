const btn = document.getElementById("theme");
const userIcone = document.getElementById("usericon");
const profileButton = document.getElementById("profilebutton")

btn.addEventListener("click", function () {
    if(btn.classList.contains("btn-light") && profileButton.classList.contains("text-white")){
      btn.classList.remove("btn-light")
      btn.classList.add("btn-dark")
      profileButton.classList.remove("text-white")
      profileButton.classList.add("text-dark")
      document.body.classList.toggle("alternate");
      userIcone.style.border = "1px solid #332d2d";
    } else if(btn.classList.contains("btn-dark") && profileButton.classList.contains("text-dark")) {
      btn.classList.add("btn-light")
      btn.classList.remove("btn-dark")
      profileButton.classList.remove("text-dark")
      profileButton.classList.add("text-white")
      document.body.classList.toggle("alternate");
    }
  });