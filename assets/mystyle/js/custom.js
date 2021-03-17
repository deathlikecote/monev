/* Declaration of variables */
var cl = document.getElementById("create-link");
var ll = document.getElementById("log-in-link");
var loginSec = document.getElementById("log-in");
var createSec = document.getElementById("create-account");

/* When #create-link clicked */
if(cl){
	cl.addEventListener("click", slideRight, true);
}

/* When #log-in-link clicked */
if(ll){
	ll.addEventListener("click", slideLeft, true);
}

/* Slide to right animation when #create-link clicked*/
function slideRight(){
	loginSec.classList.toggle("slide-right");
	createSec.classList.toggle("slide-right");
}

/* Slide to left animation when #log-in-link clicked */
function slideLeft(){
	loginSec.classList.toggle("slide-right");
	createSec.classList.toggle("slide-right");
}