<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- <link rel="stylesheet" href="/public/global.css"> -->
</head>
<body>
    Profile page <br>

    <form action="/profile" method="post">
        <label for="username">Nama:</label>
        <input disabled id="username" name="username" value="<?php if(isset($data["form"]["username"])) echo $data["form"]["username"] ?>"/>

        <?php 
        if($data["form"]["role"] == "company") {
            $location = $data["form"]["location"] ?? "";
            $about = $data["form"]["about"] ?? ""; 
            $c = <<<"EOT"
            <label for="location">Lokasi:</label>
            <input disabled id="location" name="location" value="$location"/>
            
            <label for="about">About:</label>
            <input disabled id="about" name="about" value="$about"/>
EOT;
            echo $c;
        }
        ?>
        

        <button id="edit-profile-button" type="button">Edit</button>
        <button id="save-profile-button" hidden type="submit">Save Changes</button>
        <button id="cancel-profile-button" hidden type="button">Cancel</button>
    </form>

    <form action="logout" method="post">
        <button type="submit">Logout</button>
    </form>
    
    <script src="/public/js/profile.js"></script>
</body>
</html>

