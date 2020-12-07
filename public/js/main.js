/* ---------------------------- Fonctions du menu --------------------------- */

function w3_open() {
    document.getElementById("mySidebar").style.display = "block";
}

function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
}

function myMenu() {
    var x = document.getElementById("menu");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else {
        x.className = x.className.replace(" w3-show", "");
    }
}

/* ------------------------- Fonctions du caroussel ------------------------- */

var slideIndex = 1;
var className = "image1";
showDivs(className, slideIndex);

function plusDivs(name, n) {
    showDivs(name, slideIndex += n);
}

function showDivs(name, n) {
    var i;
    var x = document.getElementsByClassName(name);
    if (n > x.length) { slideIndex = 1 }
    if (n < 1) { slideIndex = x.length }
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }
    x[slideIndex - 1].style.display = "block";
}

