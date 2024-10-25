<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Linkedin</title>
    <meta name="description" content="Login to an account">

    <link rel="stylesheet" href="/public/css/auth.css">
</head>
<body>
    <?php require "component/toaster.php"; ?>

    <section id="navbar">
        <?php require "component/navbar.php"; ?>
    </section>

    <div class="app__container">

        <main class="app__content">
    
            <div class="card">
                <h1 class="content__title ">Login</h1>
                <form method="post" class="auth__form" action="/login">
                    
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
                
                    <div class="form__bottom">
                        <button id="submit-button" class="button1" type="submit" disabled>Login </button>
                    </div>
            
                </form>
            </div>

            <br>
            <div class="register__container">
                <span>Baru mengenal LinkedIn? <a href="/register" class="button3">Bergabung sekarang</a></span>
                
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

