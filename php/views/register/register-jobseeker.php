<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- <form action="/register/jobseeker" method="post">

        <label for="username">Username:</label> 
        <input id="username" name="username" required="" type="text" value="<?php if(isset($data["form"]["username"])) echo $data["form"]["username"] ?>"/>
        <div id="username-message"><?php if(isset($data["error"]["username"])) echo $data["error"]["username"] ?></div>
        
        <label for="email">Email:</label>
        <input id="email" name="email" required="" type="email" value="<?php if(isset($data["form"]["email"])) echo $data["form"]["email"] ?>"/>
        <div id="email-message"><?php if(isset($data["error"]["email"])) echo $data["error"]["email"] ?></div>
        
        <label for="password">Password:</label>
        <input id="password" name="password" required="" type="password" minlength="8" value="<?php if(isset($data["form"]["password"])) echo $data["form"]["password"] ?>"/>
        <div id="password-message"><?php if(isset($data["error"]["password"])) echo $data["error"]["password"] ?></div>

        <label for="confirmpassword">Confirm Password:</label>
        <input id="confirmpassword" name="confirmpassword" required="" type="password" minlength="8" value="<?php if(isset($data["form"]["confirmpassword"])) echo $data["form"]["confirmpassword"] ?>"/>
        <div id="confirmpassword-message"><?php if(isset($data["error"]["confirmpassword"])) echo $data["error"]["confirmpassword"] ?></div>


        <button type="submit">Register</button>
    </form>
    <div>Already have an account?</div>
    <a href="/login">Login</a> -->
    
    
    <div id="app__container" class="glimmer">
        <header>
            <a class="linkedin-logo" href="/" aria-label="LinkedIn">
                <?php require_once 'views/component/linkedin-logo-medium.php'; ?>
            </a>
        </header>

        <main class="app__content" role="main">
            <form method="post" id="otp-generation" class="hidden">
            
            <input name="csrfToken" value="ajax:4190473608964218407" type="hidden">  

            <input name="resendUrl" id="input-resend-otp-url" type="hidden">
            <input name="midToken" type="hidden">
            <input name="session_redirect" type="hidden">
            <input name="parentPageKey" value="d_checkpoint_lg_consumerLogin" type="hidden">
            <input name="pageInstance" value="urn:li:page:checkpoint_lg_login_default;31RNBdpVSnOc3CGFEutPug==" type="hidden">
            <input name="controlId" value="d_checkpoint_lg_consumerLogin-SignInUsingOneTimeSignInLink" type="hidden">
            <input name="session_redirect" type="hidden">
            <input name="trk" type="hidden">
            <input name="authUUID" type="hidden">
            <input name="encrypted_session_key" type="hidden">
            </form>
            
    
            <div class="card-layout">
                <div id="organic-div">
                    <div class="header__content ">
                        <h1 class="header__content__heading ">Login</h1>
                        <p class="header__content__subheading "></p>
                    </div>
                    <form method="post" class="login__form" action="/checkpoint/lg/login-submit" novalidate="">
                    
                        <input name="csrfToken" value="ajax:4190473608964218407" type="hidden">  
                        
                        <div class="form__input mt-24">
                            <input id="username" name="session_key" aria-describedby="error-for-username" required="" validation="email|tel" value="" autofocus="" autocomplete="username" aria-label="Email atau telepon" type="text">
                            <label class="form__label--floating" for="username" aria-hidden="true">
                            Email atau telepon
                            </label>
                            <div error-for="username" id="error-for-username" class="error__label  hidden" role="alert" aria-live="assertive"></div>
                        </div>
                
                
                        <div class="form__input mt-24">
                            <input id="password" aria-describedby="error-for-password" name="session_password" required="" validation="password" autocomplete="current-password" aria-label="Kata sandi" type="password">
                            <label for="password" class="form__label--floating" aria-hidden="true">
                                Kata sandi
                            </label>
                            <span id="password-visibility-toggle" class="button4" role="button" tabindex="0">
                                Tampilkan
                            </span>
                            <div error-for="password" id="error-for-password" class="error__label  hidden" role="alert" aria-live="assertive"></div>
                        </div>
                    
                        <div class="form__bottom ">
                            <button class="button1 from__button--floating" data-litms-control-urn="login-submit" aria-label="Login" type="submit">Login </button>
                        </div>
                
                    </form>
                </div>
            </div>


            <div class="join-now">
                Baru mengenal LinkedIn? 
                <a href="/signup/cold-join" class="button3" id="join_now" data-litms-control-urn="login_join_now" data-cie-control-urn="join-now-btn">Bergabung sekarang</a>
            </div>
        </main>

        <footer class="footer__base" role="contentinfo">
        <div class="footer__base__wrapper">
          <p class="copyright">
              

            <?php require_once 'views/component/linkedin-logo-small.php'; ?>

  
            <em>
              <span class="a11y__label">
                LinkedIn
              </span>
              © 2024
            </em>
          </p>
          <div>
        </div>
        </div>
    </footer>
  
        
    <artdeco-toasts></artdeco-toasts>
    <span class="hidden toast-success-icon">
      

            <li-icon size="small" aria-hidden="true" type="success-pebble-icon"><svg viewBox="0 0 24 24" width="24px" height="24px" x="0" y="0" preserveAspectRatio="xMinYMin meet" class="artdeco-icon" focusable="false">
                    <g class="small-icon" style="fill-opacity: 1">
                        <circle class="circle" r="6.1" stroke="currentColor" stroke-width="1.8" cx="8" cy="8" fill="none" transform="rotate(-90 8 8)"></circle>
                        <path d="M9.95,5.033l1.2,0.859l-3.375,4.775C7.625,10.875,7.386,10.999,7.13,11c-0.002,0-0.003,0-0.005,0    c-0.254,0-0.493-0.12-0.644-0.325L4.556,8.15l1.187-0.875l1.372,1.766L9.95,5.033z" fill="currentColor"></path>
                    </g>
                </svg></li-icon>

  
    </span>
    <span class="hidden toast-error-icon">
      

        <li-icon size="small" aria-hidden="true" type="error-pebble-icon"><svg viewBox="0 0 24 24" width="24px" height="24px" x="0" y="0" preserveAspectRatio="xMinYMin meet" class="artdeco-icon" focusable="false">
                <g class="small-icon" style="fill-opacity: 1">
                    <circle class="circle" r="6.1" stroke="currentColor" stroke-width="1.8" cx="8" cy="8" fill="none" transform="rotate(-90 8 8)"></circle>
                    <path fill="currentColor" d="M10.916,6.216L9.132,8l1.784,1.784l-1.132,1.132L8,9.132l-1.784,1.784L5.084,9.784L6.918,8L5.084,6.216l1.132-1.132L8,6.868l1.784-1.784L10.916,6.216z">
                    </path>
                </g>
            </svg>
        </li-icon>

  
    </span>
    <span class="hidden toast-notify-icon">
      

        <li-icon size="small" aria-hidden="true" type="yield-pebble-icon"><svg viewBox="0 0 24 24" width="24px" height="24px" x="0" y="0" preserveAspectRatio="xMinYMin meet" class="artdeco-icon" focusable="false">
                <g class="small-icon" style="fill-opacity: 1">
                    <circle class="circle" r="6.1" stroke="currentColor" stroke-width="1.8" cx="8" cy="8" fill="none" transform="rotate(-90 8 8)"></circle>
                    <path d="M7,10h2v2H7V10z M7,9h2V4H7V9z"></path>
                </g>
            </svg></li-icon>

  
    </span>
    <span class="hidden toast-gdpr-icon">
      

        <li-icon aria-hidden="true" size="small" type="shield-icon"><svg viewBox="0 0 24 24" width="24px" height="24px" x="0" y="0" preserveAspectRatio="xMinYMin meet" class="artdeco-icon" focusable="false">
                <path d="M8,1A10.89,10.89,0,0,1,2.87,3,1,1,0,0,0,2,4V9.33a5.67,5.67,0,0,0,2.91,5L8,16l3.09-1.71a5.67,5.67,0,0,0,2.91-5V4a1,1,0,0,0-.87-1A10.89,10.89,0,0,1,8,1ZM4,4.7A12.92,12.92,0,0,0,8,3.26a12.61,12.61,0,0,0,3.15,1.25L4.45,11.2A3.66,3.66,0,0,1,4,9.46V4.7Zm6.11,8L8,13.84,5.89,12.66A3.65,3.65,0,0,1,5,11.92l7-7V9.46A3.67,3.67,0,0,1,10.11,12.66Z" class="small-icon" style="fill-opacity: 1"></path>
            </svg></li-icon>
  
    </span>
    <span class="hidden toast-cancel-icon">
      

            <li-icon size="large" type="cancel-icon">
                <svg x="0" y="0" id="cancel-icon" preserveAspectRatio="xMinYMin meet" viewBox="0 0 24 24" width="24px" height="24px" style="color: black;">
                    <svg class="small-icon" style="fill-opacity: 1;">
                        <path d="M12.99,4.248L9.237,8L13,11.763L11.763,13L8,9.237L4.237,13L3,11.763L6.763,8L3,4.237L4.237,3L8,6.763l3.752-3.752L12.99,4.248z"></path>
                    </svg>
                    <svg class="large-icon" style="fill: currentColor;">
                        <path d="M20,5.237l-6.763,6.768l6.743,6.747l-1.237,1.237L12,13.243L5.257,19.99l-1.237-1.237l6.743-6.747L4,5.237L5.237,4L12,10.768L18.763,4L20,5.237z"></path>
                    </svg>
                </svg>
            </li-icon>

  
    </span>
  
      
            

        <div id="loader-wrapper" class="hidden">
          

            <li-icon class="blue" size="medium" aria-hidden="true" type="loader">
                <div class="artdeco-spinner"><span class="artdeco-spinner-bars"></span><span class="artdeco-spinner-bars"></span><span class="artdeco-spinner-bars"></span><span class="artdeco-spinner-bars"></span><span class="artdeco-spinner-bars"></span><span class="artdeco-spinner-bars"></span><span class="artdeco-spinner-bars"></span><span class="artdeco-spinner-bars"></span><span class="artdeco-spinner-bars"></span><span class="artdeco-spinner-bars"></span><span class="artdeco-spinner-bars"></span><span class="artdeco-spinner-bars"></span></div>
            </li-icon>

  
        </div>
    </div>
    <script src="/public/js/register/register-jobseeker.js"></script>
</body>
</html>

