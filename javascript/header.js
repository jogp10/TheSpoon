// When the user scrolls the page, execute myFunction
window.onscroll = function() { myFunction() };

// Get the header
var searchBar = document.getElementById("searchRestaurant");

// Get the offset position of the navbar
var sticky = searchBar.offsetTop;

// Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position
function myFunction() {
    if (window.pageYOffset > sticky) {
        searchBar.classList.add("sticky");
    } else {
        searchBar.classList.remove("sticky");
    }
}

function openLogInForm() {
    document.getElementById("loginForm").style.display = "block";
}

function closeLogInForm() {
    document.getElementById("loginForm").style.display = "none";
}


function openRegisterForm() {
    document.getElementById("registerForm").style.display = "block";
}

function closeRegisterForm() {
    document.getElementById("registerForm").style.display = "none";
}


function openDescription(id) {
    let restDesc = "restDesc-" + id;
    let descOpen = "descOpen-" + id;
    let descClose = "descClose-" + id;
    document.getElementById(restDesc).style.display = "block";
    document.getElementById(descOpen).style.display = "none";
    document.getElementById(descClose).style.display = "block";
}

function closeDescription(id) {
    let restDesc = "restDesc-" + id;
    let descOpen = "descOpen-" + id;
    let descClose = "descClose-" + id;
    document.getElementById(restDesc).style.display = "none";
    document.getElementById(descOpen).style.display = "block";
    document.getElementById(descClose).style.display = "none";
}