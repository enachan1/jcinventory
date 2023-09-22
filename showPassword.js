function isChecked() {
    var isCheckboxChecked = document.getElementById("checkboxPass");
    var inputPassword = document.getElementById("password");

    if(isCheckboxChecked.checked) {
        inputPassword = inputPassword.type = "text";
    }
    else {
        inputPassword = inputPassword.type = "password";
    }
}