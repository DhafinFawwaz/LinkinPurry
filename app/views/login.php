<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        echo "<div>Login</div>";
        require_once __DIR__ . "/../models/user.php";

        $allUsers = User::getAllUserLikeUsername("");
        foreach($allUsers as $x) {
            echo $x["name"]; echo "<br>";
        }
    ?>
    
</body>
</html>

