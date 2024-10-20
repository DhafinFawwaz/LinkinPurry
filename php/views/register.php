<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Linkedin</title>

    <link rel="stylesheet" href="/public/css/auth.css">
</head>
<body>
    <section id="navbar">
        <?php require "component/navbar.php"; ?>
    </section>

    <div class="app__container">
        <main class="app__content">
            <div class="top__content">
                Dapatkan manfaat maksimal dari dunia profesional Anda
            </div>
    
            <div class="card">
                <h1 class="content__title ">Register</h1>

                <form method="post" class="auth__form" action="/register">
                    <div class="form__switch">
                        <div>
                            <input hidden type="radio" id="jobseeker__switch" name="role" value="jobseeker" <?php if(isset($data["form"]["roles"]) && $data["form"]["roles"] == 'jobseeker') echo 'checked' ?>>
                            <label class="role__switch" for="jobseeker__switch">Jobseeker</label>
                        </div>
                        <div>
                            <input hidden type="radio" id="company__switch" name="role" value="company" <?php if(isset($data["form"]["roles"]) && $data["form"]["roles"] == 'jobseeker') echo 'checked' ?>>
                            <label class="role__switch" for="company__switch">Company</label>
                        </div>
                    </div>

                    <div class="form__input">
                        <input id="username" name="username" required="" autofocus="" type="text" value="<?php if(isset($data["form"]["username"])) echo $data["form"]["username"] ?>">
                        <label for="username">Username</label>
                        <div id="username-message" class="error__label"><?php if(isset($data["error"]["username"])) echo $data["error"]["username"] ?></div>
                    </div>

                    <div class="form__input">
                        <input id="email" name="email" required="" autofocus="" type="text" value="<?php if(isset($data["form"]["email"])) echo $data["form"]["email"] ?>">
                        <label for="email">Email</label>
                        <div id="email-message" class="error__label"><?php if(isset($data["error"]["email"])) echo $data["error"]["email"] ?></div>
                    </div>

                    <div class="form__input">
                        <input id="password" name="password" required="" autofocus="" type="password" value="<?php if(isset($data["form"]["password"])) echo $data["form"]["password"] ?>">
                        <label for="password">Password</label>
                        <div id="password-message" class="error__label"><?php if(isset($data["error"]["password"])) echo $data["error"]["password"] ?></div>
                    </div>

                    <div class="form__input">
                        <input id="confirmpassword" name="confirmpassword" required="" autofocus="" type="password" value="<?php if(isset($data["form"]["confirmpassword"])) echo $data["form"]["confirmpassword"] ?>">
                        <label for="confirmpassword">confirmpassword</label>
                        <div id="confirmpassword-message" class="error__label"><?php if(isset($data["error"]["confirmpassword"])) echo $data["error"]["confirmpassword"] ?></div>
                    </div>

                    <div class="form__input">
                        <input id="location" name="location" autofocus="" type="text" value="<?php if(isset($data["form"]["location"])) echo $data["form"]["location"] ?>">
                        <label for="location">location</label>
                        <div id="location-message" class="error__label"><?php if(isset($data["error"]["location"])) echo $data["error"]["location"] ?></div>
                    </div>

                    <div class="form__input">
                        <input id="about" name="about" autofocus="" type="text" value="<?php if(isset($data["form"]["about"])) echo $data["form"]["about"] ?>">
                        <label for="about">about</label>
                        <div id="about-message" class="error__label"><?php if(isset($data["error"]["about"])) echo $data["error"]["about"] ?></div>
                    </div>
                
                    <div class="form__bottom">
                        <button id="submit-button" class="button1" type="submit" disabled>Register </button>
                    </div>
            
                </form>
            </div>

            <br>
            <div class="register__container">
                <span>Sudah di LinkedIn? <a href="/login" class="button3">Login</a></span>
                
            </div>
        </main>

        <footer class="footer__base">
            <div class="footer__base__wrapper">
                <p class="copyright">
                    <?php require_once 'views/component/linkedin-logo-small.php'; ?>
                </p>
                © 2024
            </div>
        </footer>
      
            
    </div>

    <script src="/public/js/auth-page.js"></script>
</body>
</html>

