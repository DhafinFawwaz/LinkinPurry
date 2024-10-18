<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Linkedin</title>

    <link rel="stylesheet" href="/public/css/login.css">
</head>
<body>

    <div class="app__container">
        <header>
            <a class="linkedin-logo" href="/" aria-label="LinkedIn">
                <?php require_once 'views/component/linkedin-logo-medium.php'; ?>
            </a>
        </header>

        <main class="app__content">
    
            <div class="card">
                <h1 class="content__title ">Login</h1>
                <form method="post" class="login__form" action="/login">
                    
                    <div class="form__input">
                        <input id="email" name="email" required="" autofocus="" type="text" value="<?php if(isset($data["form"]["email"])) echo $data["form"]["email"] ?>">
                        <label for="email">Email atau telepon</label>
                        <div class="error__label"><?php if(isset($data["error"]["email"])) echo $data["error"]["email"] ?></div>
                    </div>

                    <div class="form__input">
                        <input id="password" name="password" required="" autofocus="" type="password" value="<?php if(isset($data["form"]["password"])) echo $data["form"]["password"] ?>">
                        <label for="password">Password</label>
                        <div class="error__label"><?php if(isset($data["error"]["password"])) echo $data["error"]["password"] ?></div>
                    </div>
                
                    <div class="form__bottom">
                        <button class="button1" data-litms-control-urn="login-submit" aria-label="Login" type="submit">Login </button>
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

</body>
</html>

