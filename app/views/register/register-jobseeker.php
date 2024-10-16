<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="/register/jobseeker" method="post">

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
    
    <script src="/public/js/register/register-jobseeker.js"></script>
</body>
</html>

