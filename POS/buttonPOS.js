// Function for buttons POS when pressing keyboard button
document.addEventListener("keydown", function(event) {
    if (event.key === "F1"){
        event.preventDefault();
        document.getElementById("F1Button").click();
    }
})
document.addEventListener("keydown", function(event) {
    if (event.key === "F2"){
        event.preventDefault();
        document.getElementById("F2Button").click();
    }
})
document.addEventListener("keydown", function(event) {
    if (event.key === "F3"){
        event.preventDefault();
        document.getElementById("F3Button").click();
    }
})
document.addEventListener("keydown", function(event) {
    if (event.key === "F4"){
        event.preventDefault();
        document.getElementById("F4Button").click();
    }
})
document.addEventListener("keydown", function(event) {
    if (event.key === "F5"){
        event.preventDefault();
        document.getElementById("F5Button").click();
    }
})

document.addEventListener("keydown", function(event){
    if(event.key === "F6"){
        event.preventDefault();
        document.getElementById("F6Button").click();
    }
})