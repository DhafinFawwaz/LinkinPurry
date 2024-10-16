<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="register" method="post">

        <label for="username">Username:</label> 
        <input id="username" name="username" required="" type="text" value="<?php if(isset($data["form"]["username"])) echo $data["form"]["username"] ?>"/>
        <div id="username-message"><?php if(isset($data["error"]["username"])) echo $data["error"]["username"] ?></div>
        
        <label for="email">Email:</label>
        <input id="email" name="email" required="" type="email" value="<?php if(isset($data["form"]["email"])) echo $data["form"]["email"] ?>"/>
        <div id="email-message"><?php if(isset($data["error"]["email"])) echo $data["error"]["email"] ?></div>
        
        <label for="password">Password:</label>
        <input id="password" name="password" required="" type="password" minlength="8" value="<?php if(isset($data["form"]["password"])) echo $data["form"]["password"] ?>"/>
        <div id="password-message"><?php if(isset($data["error"]["password"])) echo $data["error"]["password"] ?></div>

        <label for="confirmpassword">Confirm Password:</label>
        <input id="confirmpassword" name="confirmpassword" required="" type="password" minlength="8" value="<?php if(isset($data["form"]["confirmpassword"])) echo $data["form"]["confirmpassword"] ?>"/>
        <div id="confirmpassword-message"><?php if(isset($data["error"]["confirmpassword"])) echo $data["error"]["confirmpassword"] ?></div>


        <button type="submit">Register</button>
    </form>
    <div>Already have an account?</div>
    <a href="/login">Login</a>
    
    <script>
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

        // atleast 8 character, contain number and letter
        function validatePassword() {
            if (passwordInput.value === "") {
                passwordMessage.textContent = "Password is required";
            } else if (passwordInput.value.length < 8) {
                passwordMessage.textContent = "Password must be at least 8 characters";
            } else if (!/\d/.test(passwordInput.value) || !/[a-zA-Z]/.test(passwordInput.value)) {
                passwordMessage.textContent = "Password must contain at least one letter and one number";
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

    </script>
</body>
</html>

