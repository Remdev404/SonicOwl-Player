// GETTING DESIRED TARGETS //

const searchBar = document.getElementById("searchinput");
const middleColumn = document.getElementById("middlecolumn");
const searchButton = document.getElementById("searchbutton");
const mainSection = document.getElementById("main");
const home = document.getElementById("home");
const community = document.getElementById("community");
const library = document.getElementById("library");
const searchButtonIcon = document.getElementById("searchbuttonicon");

// SEARCH BAR APPEAR ONCLICK //

searchButton.addEventListener("click", function (event) {
  home.style.display = "none";
  community.style.display = "none";
  library.style.display = "none";
  searchButton.style.display = "none";
  searchButtonIcon.style.display = "none";
  searchBar.style.display = "block";
  event.preventDefault();
});

// SEARCH BAR DISAPEAR ONCLICK ELSEWHERE //

mainSection.addEventListener("click", function () {
  home.style.display = "block";
  community.style.display = "block";
  library.style.display = "block";
  searchButton.style.display = "block";
  searchButtonIcon.style.display = "block";
  searchBar.style.display = "none";
});