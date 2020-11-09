let vh = window.innerHeight / 100;
document.documentElement.style.setProperty('--vh', `${vh}px`);



function nextStep(next) {
    var last = next-1;
    var currentObjects = document.getElementById("step" + last).querySelectorAll(".required");
    for (let i = 0; i < currentObjects.length; i++) {
        if (currentObjects[i].value == "") {
            currentObjects[i].classList.add("error");
            currentObjects[i].focus(); // focuses on that particular input
            return false;
        }
    }
    for (let i = 0; i < currentObjects.length; i++) {
        currentObjects[i].classList.remove("error");
    }
    document.getElementById("step" + next).classList.toggle("active");
    document.getElementById("step" + last).classList.toggle("active");
    document.getElementById("step" + last).classList.toggle("past");
    document.getElementById("progress" + next).classList.toggle("active");
}

function lastStep(last) {
    var next = last+1;
    document.getElementById("step" + next).classList.toggle("active");
    document.getElementById("step" + last).classList.toggle("active");
    document.getElementById("step" + last).classList.toggle("past");
    document.getElementById("progress" + next).classList.toggle("active");
}







window.addEventListener('resize', () => {

var vh = window.innerHeight / 100;
document.documentElement.style.setProperty('--vh', `${vh}px`);



});