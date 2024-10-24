<?php
$message = new Message("", "", "");
if(isset($_SESSION["message"]) && $_SESSION["message"]) {
    /** @var Message */
    $message = $_SESSION["message"];
}
?>

<div class="toast-wrapper">
    <link rel="stylesheet" href="/public/css/toaster.css">

    <div class="toast-container" style="transform: translateX(0%) translateY(100%); transition: transform 0.25s cubic-bezier(0.19, 1, 0.22, 1);">
        
        <div class="toast-bg">
            <div class="toast-progress-wrapper">
                <div class="toast-progress-<?= $message->level ?>" id="toast-progress"></div>
            </div>
        </div>
        
        <button class="toast-close-button" id="toast-close-button">
            <img alt="close-icon" src="https://api.iconify.design/iconamoon/close-bold.svg?color=black" alt="" class="close-icon">
        </button>

        <div class="toast-content">
            <h2 class="toast-message-<?= $message->level ?>" id="toast-title"><?= $message->title ?></h2>
            <div class="toast-description-wrapper">
                <p class="toast-description" id="toast-content">
                    <?= $message->content ?>
                </p>
            </div>
        </div>
    </div>
    <script src="/public/js/toaster.js"></script>
</div>