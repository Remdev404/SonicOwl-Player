const btn = document.getElementById("theme");
const libraryButton = document.getElementById("librarybutton");

btn.addEventListener("click", function () {
  if(libraryButton.classList.contains("text-white")){
    libraryButton.classList.remove("text-white");
    libraryButton.classList.add("text-dark");
  }
  document.body.classList.toggle("alternate");
});
