const usernameInput = document.getElementById("username");
const usernameMessage = document.getElementById("username-message");
const emailInput = document.getElementById("email");
const emailMessage = document.getElementById("email-message");
const passwordInput = document.getElementById("password");
const confirmPasswordInput = document.getElementById("confirmpassword");
const passwordMessage = document.getElementById("password-message");
const confirmPasswordMessage = document.getElementById("confirmpassword-message");

// username is required
function validateUsername() {
    if (usernameInput.value === "") {
        usernameMessage.textContent = "Username is required";
    } else {
        usernameMessage.textContent = "";
    }
}

// regex validation for email
function validateEmail() {
    const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (emailInput.value === "") {
        emailMessage.textContent = "Email is required";
    } else if (!emailRegex.test(emailInput.value)) {
        emailMessage.textContent = "Invalid email address";
    } else {
        emailMessage.textContent = "";
    }
}

function hasLetterAndNumber(str) { 
    return /[a-zA-Z]/.test(str) && /\d/.test(str); 
}

// atleast 8 character, contain number and letter
function validatePassword() {
    if (passwordInput.value === "") {
        passwordMessage.textContent = "Password is required";
    } else if (passwordInput.value.length < 8) {
        passwordMessage.textContent = "At least 8 characters";
    } else if (!hasLetterAndNumber(passwordInput.value)) {
        passwordMessage.textContent = "At least one letter and one number";
    } else {
        passwordMessage.textContent = "";
    }
}

// check if password and confirm password match
function validateConfirmPassword() {
    if (confirmPasswordInput.value === "") {
        confirmPasswordMessage.textContent = "Confirm password is required";
    } else if (passwordInput.value !== confirmPasswordInput.value) {
        confirmPasswordMessage.textContent = "Passwords do not match";
    } else {
        confirmPasswordMessage.textContent = "";
    }
}

usernameInput.addEventListener("focusout", validateUsername);
emailInput.addEventListener("focusout", validateEmail);
passwordInput.addEventListener("focusout", validatePassword);
confirmPasswordInput.addEventListener("focusout", validateConfirmPassword);