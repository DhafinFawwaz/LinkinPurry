(() => {
    const usernameInput = document.getElementById("username");
const usernameMessage = document.getElementById("username-message");
const emailInput = document.getElementById("email");
const emailMessage = document.getElementById("email-message");
const passwordInput = document.getElementById("password");
const confirmPasswordInput = document.getElementById("confirmpassword");
const passwordMessage = document.getElementById("password-message");
const confirmPasswordMessage = document.getElementById("confirmpassword-message");
const locationInput = document.getElementById("location");
const aboutInput = document.getElementById("about");
const submitButton = document.getElementById("submit-button");

// username is required
function validateUsername() {
    if (usernameInput.value === "") {
        usernameMessage.textContent = "Username is required";
        return false;
    } else {
        usernameMessage.textContent = "";
        return true;
    }
}
function isUsernameValid() {
    return !usernameInput || usernameInput.value.length > 0;
}

// regex validation for email
function validateEmail() {
    const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (emailInput.value === "") {
        emailMessage.textContent = "Email is required";
        return false;
    } else if (!emailRegex.test(emailInput.value)) {
        emailMessage.textContent = "Invalid email address";
        return false;
    } else {
        emailMessage.textContent = "";
        return true;
    }
}
function isEmailValid() {
    const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    return !emailInput || emailInput.value.length > 0 && emailRegex.test(emailInput.value);
}

function hasLetterAndNumber(str) { 
    return /[a-zA-Z]/.test(str) && /\d/.test(str); 
}

// atleast 8 character, contain number and letter
function validatePassword() {
    if (passwordInput.value === "") {
        passwordMessage.textContent = "Password is required";
        return false;
    } else if (passwordInput.value.length < 8) {
        passwordMessage.textContent = "At least 8 characters";
        return false;
    } else if (!hasLetterAndNumber(passwordInput.value)) {
        passwordMessage.textContent = "At least one letter and one number";
        return false;
    } else {
        passwordMessage.textContent = "";
        return true;
    }
}
function isPasswordValid() {
    return !passwordInput || passwordInput.value.length > 0 && passwordInput.value.length >= 8 && hasLetterAndNumber(passwordInput.value);
}

// check if password and confirm password match
function validateConfirmPassword() {
    if (confirmPasswordInput.value === "") {
        confirmPasswordMessage.textContent = "Confirm password is required";
        return false;
    } else if (passwordInput.value !== confirmPasswordInput.value) {
        confirmPasswordMessage.textContent = "Passwords do not match";
        return false;
    } else {
        confirmPasswordMessage.textContent = "";
        return true;
    }
}
function isConfirmPasswordValid() {
    return !confirmPasswordInput || confirmPasswordInput.value.length > 0 && passwordInput.value === confirmPasswordInput.value;
}

function validateForm() {
    if (isUsernameValid() && isEmailValid() && isPasswordValid() && isConfirmPasswordValid()) {
        submitButton.removeAttribute("disabled");
    } else {
        submitButton.setAttribute("disabled", true);
    }
}

if(usernameInput) usernameInput.addEventListener("focusout", validateUsername);
if(emailInput) emailInput.addEventListener("focusout", validateEmail);
if(passwordInput) passwordInput.addEventListener("focusout", validatePassword);
if(confirmPasswordInput) confirmPasswordInput.addEventListener("focusout", validateConfirmPassword);

if(usernameInput) usernameInput.addEventListener("input", validateForm);
if(emailInput) emailInput.addEventListener("input", validateForm);
if(passwordInput) passwordInput.addEventListener("input", validateForm);
if(confirmPasswordInput) confirmPasswordInput.addEventListener("input", validateForm);
if(locationInput) locationInput.addEventListener("input", validateForm);
if(aboutInput) aboutInput.addEventListener("input", validateForm);

validateForm();

})();
