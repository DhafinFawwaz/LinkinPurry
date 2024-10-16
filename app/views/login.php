<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- <link rel="stylesheet" href="/public/global.css"> -->
</head>
<body>
    <form action="/login" method="post">

        <label for="email">Email:</label>
        <input id="email" name="email" required="" type="email"  value="<?php if(isset($data["form"]["email"])) echo $data["form"]["email"] ?>"/>
        <div><?php if(isset($data["error"]["email"])) echo $data["error"]["email"] ?></div>

        <label for="password">Password:</label>
        <input id="password" name="password" required="" type="password"  value="<?php if(isset($data["form"]["password"])) echo $data["form"]["password"] ?>"/>
        <div><?php if(isset($data["error"]["password"])) echo $data["error"]["password"] ?></div>
    
        <button type="submit">Login</button>
    </form>
    <div>Don't have an account?</div>
    <a href="/register/company">Register as Company</a>
    <a href="/register/jobseeker">Register as jobseeker</a>

</body>
</html>

