<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if(isset($data["form"]["username"])) echo $data["form"]["username"] ?> - LinkinPurry</title>

    <link rel="stylesheet" href="/public/css/profile.css">
</head>
<body>
    <?php include 'component/toaster.php'; ?>
    <?php include 'component/navbar.php'; ?>

    <section class="edit-popup hide">
        <div class="black-bg">a</div>
        <div class="popup-content">
            <div>
                <h2>Edit Profile</h2>
                <button class="icon-button close-button">
                    <?php require "component/close-icon.php"; ?>
                </button>
            </div>
            <div class="profile-form" action="/profile" method="post">
                <div class="form__input">
                    <input id="username" name="username" required="" autofocus="" type="text" value="<?php if(isset($data["form"]["username"])) echo $data["form"]["username"] ?>"/>
                    <label for="username">Nama:</label>
                </div>

                <?php 
                if($data["form"]["role"] == "company") {
                    $location = $data["form"]["location"] ?? ""; $location = htmlspecialchars($location);
                    $about = $data["form"]["about"] ?? ""; $about = htmlspecialchars($about); 
                    $c = <<<"EOT"
                <div class="form__input">
                    <input id="location" name="location" required=""  value="$location"/>
                    <label for="location">Lokasi:</label>
                </div>
                    
                <div class="form__input">
                    <input id="about" name="about" required=""  value="$about"/>
                    <label for="about">About:</label>
                </div>
EOT;
                    echo $c;
                }
                ?>
                
                <div class="edit-container">
                    <button id="update-button" class="button1" id="save-profile-button">Save Changes</button>
                    <button class="outline-button" id="cancel-profile-button">Cancel</button>
                </div>
            </div>

            
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
                <div id="profile-container" class="profile-info">
                    <?php 
                        echo "<h1>".htmlspecialchars($data["form"]["username"])."</h1>"; 
                        echo "<h2 class='email-title'>".htmlspecialchars($data["form"]["email"])."</h1>"; 
                        if($data["form"]["role"] == "company") {
                            echo "<p>".htmlspecialchars($data["form"]["location"])."</p>";
                            echo "<p>".htmlspecialchars($data["form"]["about"])."</p>";
                        }
                    ?>
                </div>
            </div>

            <form class="logout-button-container" action="logout" method="post">
                <button class="outline-button" type="submit">Logout</button>
            </form>
        </section>

    </main>

    
    
    <script src="/public/js/profile.js"></script>
</body>
</html>

