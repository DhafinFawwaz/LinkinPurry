<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- <link rel="stylesheet" href="/public/global.css"> -->
</head>
<body>
    Profile page <br>
    <?php
        /** @var User */
        $user = $_SESSION['user'];
        echo $user->email."<br>";
        echo $user->username."<br>";
        echo $user->password."<br>";
        echo $user->role."<br>";
    ?>

    <form action="logout" method="post">
        <button type="submit">Logout</button>
    </form>
    
</body>
</html>

