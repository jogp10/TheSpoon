// When the user scrolls the page, execute myFunction
window.onscroll = function() { myFunction() };

// Get the header
var topnav = document.getElementsByClassName("topnav");

// Get the offset position of the navbar
var sticky = topnav.offsetTop;

// Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position
function myFunction() {
    if (window.pageYOffset > sticky) {
        topnav.classList.add("sticky");
    } else {
        topnav.classList.remove("sticky");
    }
}

function openLogInForm() {
    const loginForm = document.getElementById("loginForm");
    loginForm.style.display = "block";
    if(loginForm.offsetHeight > window.innerHeight) {
        loginForm.style.height = window.innerHeight + 'px';
        loginForm.style.overflowY = 'scroll';
    }
}

function closeLogInForm() {
    document.getElementById("loginForm").style.display = "none";
}


function openRegisterForm() {
    const registerForm = document.getElementById("registerForm");
    registerForm.style.display = "block";
    if(registerForm.offsetHeight > window.innerHeight) {
        registerForm.style.height = window.innerHeight + 'px';
        registerForm.style.overflowY = 'scroll';
    }
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