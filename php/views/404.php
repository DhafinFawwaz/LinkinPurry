<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Not found</title>

    <link rel="stylesheet" href="/public/css/404.css">
</head>
<body>
    <?php include 'component/toaster.php'; ?>
    <?php include 'component/navbar.php'; ?>

    <div class="app__container">

        <main class="app__content">
    
            <div class="card">
                <h1 class="content__title "><span class="code">404</span> Not Found</h1>
                <p>Not what you're looking for? back to <a href="/" class="button1">Home</a></p>
            </div>
        </main>

        <footer class="footer__base">
            <div class="footer__base__wrapper">
                <p class="copyright">
                    <?php require_once 'views/component/linkinpurry-dark-logo.php'; ?>
                </p>
                © 2024
            </div>
        </footer>

    </div>

</body>
</html>

