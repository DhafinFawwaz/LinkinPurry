<?php
if(isset($_SESSION["message"]) && $_SESSION["message"]) {
    /** @var Message */
    $message = $_SESSION["message"];
    echo <<<EOD
    <div class="toast-wrapper">
        <link rel="stylesheet" href="/public/css/toaster.css">

        <div class="toast-container" style="transform: translateX(0%); translateY(100%) transition: transform 0.25s cubic-bezier(0.19, 1, 0.22, 1);">
        
        <div class="toast-bg">
            <div class="toast-progress-wrapper">
EOD;
        if($message->level == "error") {
            echo <<<EOD
            <div class="toast-progress-error" style="transition-duration: 5s;" id="toast-progress"></div>
EOD;
        } else if($message->level == "success") {
            echo <<<EOD
            <div class="toast-progress-success" style="transition-duration: 5s;" id="toast-progress"></div>
EOD;
        } else if($message->level == "info") {
            echo <<<EOD
            <div class="toast-progress-info" style="transition-duration: 5s;" id="toast-progress"></div>
EOD;
        }
        echo <<<EOD
            </div>
        </div>
        
        <button class="toast-close-button" id="toast-close-button">
            <img alt="close-icon" src="https://api.iconify.design/iconamoon/close-bold.svg?color=black" alt="" class="close-icon">
        </button>

        <div class="toast-content">
EOD;
        if($message->level == "error") {
            echo <<<EOD
            <h2 class="toast-message-error">{$message->title}</h2>
EOD;
        } else if($message->level == "success") {
            echo <<<EOD
            <h2 class="toast-message-success">{$message->title}</h2>
EOD;
        } else if($message->level == "info") {
            echo <<<EOD
            <h2 class="toast-message-info">{$message->title}</h2>
EOD;
        }
        echo <<<EOD
            <div class="toast-description-wrapper">
                <p class="toast-description">
                    {$message->content}
                </p>
        </div>
    </div>
    </div>
    <script src="/public/js/toaster.js"></script>
</div>
EOD;
}