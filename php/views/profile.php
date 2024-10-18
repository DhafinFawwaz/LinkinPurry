<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="/public/css/profile.css">
</head>
<body>
    <section class="edit-popup hide">
        <div class="black-bg">a</div>
        <div class="popup-content">
            <div>
                <h2>Edit Profile</h2>
                <button class="icon-button close-button">
                    <?php require "component/close-icon.php"; ?>
                </button>
            </div>
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
        </div>
    </section>
    
    <main>
        <section id="profile">
            <div class="profile">
                <div class="banner">
                    <img src="/public/assets/banner.svg" alt="banner">
                </div>


                <div class="profile-picture">
                    <div>
                        <img src="/public/assets/jobseeker_profile.svg" alt="profile-picture">
                    </div>
                    <button class="icon-button edit-button">
                        <?php require "component/edit-icon.php"; ?>
                    </button>
                </div>
                <div class="profile-info">
                    <?php 
                        echo "<h1>".htmlspecialchars($data["form"]["username"])."</h1>"; 
                        if($data["form"]["role"] == "company") {
                            echo "<p>".htmlspecialchars($data["form"]["location"])."</p>";
                            echo "<p>".htmlspecialchars($data["form"]["about"])."</p>";
                        }
                    ?>
                </div>
            </div>
        </section>

    </main>

    
    
    <script src="/public/js/profile.js"></script>
</body>
</html>

