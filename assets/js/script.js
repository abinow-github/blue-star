document.addEventListener("DOMContentLoaded", function() {
    var navbar = document.getElementById("mainNavigation");

    window.addEventListener("scroll", function() {
        if (window.scrollY > 50) {
            navbar.classList.add("scrolled");
        } else {
            navbar.classList.remove("scrolled");
        }
    });
});



//// client logo slider

////////////////////////////
$(document).ready(function(){
    $('.customer-logos').slick({
        slidesToShow: 6,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 0.0001, // Adjust the autoplaySpeed to a reasonable value
        speed: 2000, // Adjust the speed as needed
        arrows: false,
        dots: false,
        pauseOnHover: false,
        responsive: [{
            breakpoint: 768,
            settings: {
                slidesToShow: 4
            }
        }, {
            breakpoint: 520,
            settings: {
                slidesToShow: 3
            }
        }]
    });
});

/////////// show nabar in medium and small devices
function showNav(){
    let nav = document.getElementById('navbarNavDropdown')
    nav.classList.add('show')
}
function closeNav(){
    let nav = document.getElementById('navbarNavDropdown')
    nav.classList.remove('show')
}
////////////navbar onclick dropdown 
// Get the elements
let dropdownContainer = document.getElementById('navbarDropdownMenuLink');
let dropdownMenu = document.getElementById('dropdown-menu');
function showDropdown() {
    dropdownMenu.classList.toggle('show');
}

// Attach event listener to the dropdown container
dropdownContainer.addEventListener('click', showDropdown);






