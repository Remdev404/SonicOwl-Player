// CONCEPT SCROLL TO APPEAR OPTION

const sections = document.querySelectorAll('.genre');

// FUNCTION TO CHECK IF THE ELEMENT IS IN VIEWPORT

function isInViewport(el) {
  const rect = el.getBoundingClientRect();
  return (
    rect.top >= 0 &&
    rect.left >= 0 &&
    rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
    rect.right <= (window.innerWidth || document.documentElement.clientWidth)
  );
}


// FUNCTION TO SHOW A SECTION ELEMENT

function showSection(section) {
  section.style.opacity = 1;
  section.style.transform = 'translateY(0)';
}


// ADD LISTENERS FOR SCROLLING

window.addEventListener('scroll', () => {
  // LOOP THROUGH ALL SECTIONS
  sections.forEach((section, index) => {
    // CHECK IF THE SECTION IS IN VIEWPORT
    if (isInViewport(section)) {
      // SHOW THE SECTION IF IT HASN'T BEEN IN VIEWPORT
      if (section.style.opacity == 0) {
        setTimeout(() => {
          showSection(section);
        }, index * 200); // ADD A DELAY
      }
    }
  });
});


// SCROLL WITH BUTTONS

document.querySelector("#rapsection").addEventListener("click", function() {
    const section = document.getElementById("rap");
    section.scrollIntoView({ behavior: 'smooth' });
  });
  
  document.querySelector("#hiphopsection").addEventListener("click", function() {
    const section = document.getElementById("hiphop");
    section.scrollIntoView({ behavior: 'smooth' });
  });
  
  document.querySelector("#oldschoolsection").addEventListener("click", function() {
    const section = document.getElementById("oldschool");
    section.scrollIntoView({ behavior: 'smooth' });
  });
  
  document.querySelector("#countrysection").addEventListener("click", function() {
    const section = document.getElementById("country");
    section.scrollIntoView({ behavior: 'smooth' });
  });

// SCROLL TO TOP

const element = document.getElementById("totop");

element.addEventListener("click", function () {
  window.scrollTo({ top: 0, behavior: "smooth" });
});

window.addEventListener("scroll", function () {
  if (window.scrollY === 0) {
    element.classList.remove("active");
  } else {
    element.classList.add("active");
  }
});