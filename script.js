const elementsToAnimate = document.querySelectorAll('.scroll-animation'); // Select elements with 'scroll-animation' class

function handleScroll() {
  elementsToAnimate.forEach(element => {
    const rect = element.getBoundingClientRect();

    if (rect.top >= window.innerHeight * 0.8 || rect.bottom <= 0.5) {
      // Remove 'is-visible' class when element is out of view
      element.classList.remove('is-visible');
    } else {
      // Add 'is-visible' class when element is in view
      element.classList.add('is-visible');
    }
  });
}

window.addEventListener('scroll', handleScroll);


/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function enrollUser() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
