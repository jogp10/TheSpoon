topbutton = document.getElementById("goToTop");
window.onscroll = function() { scroll() };

function scroll() {
    if (document.body.scrollTop > 500 || document.documentElement.scrollTop > 500) {
        topbutton.style.display = "block";
    } else {
        topbutton.style.display = "none";
    }
}

function toTopFunc() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}