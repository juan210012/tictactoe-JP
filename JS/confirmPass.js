
var submit = document.getElementsByClassName("submitButton");
var pass = document.getElementById("password");
var conPass = document.getElementById("confirmPassword");

conPass.addEventListener("keyup", checkPass);
pass.addEventListener("keyup", checkPass);

function checkPass() {
    var submit = document.getElementsByClassName("submitButton");
    var pass = document.getElementById("password");
    var conPass = document.getElementById("confirmPassword");
    var checkMatched = document.getElementById("checkMatched");
    if (pass.value === conPass.value && pass.value !== "") {
        submit[0].disabled = false;
        conPass.style.border = "2px solid green";
        checkMatched.innerHTML = "Password matches!";
        checkMatched.style.color = "green";
    } else if(pass.value != conPass.value && pass.value !== "") {
        conPass.style.border = "2px solid red";
        checkMatched.innerHTML = "Password does not match!";
        checkMatched.style.color = "red";
    }
}