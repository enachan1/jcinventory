// Function for buttons POS when pressing keyboard button
document.addEventListener("keydown", function(event) {
    if (event.key === "F1"){
        event.preventDefault();
        document.getElementById("F1Button").click();
    }
})
document.addEventListener("keydown", function(event) {
    if (event.key === "F3"){
        event.preventDefault();
        document.getElementById("F3Button").click();
    }
})
