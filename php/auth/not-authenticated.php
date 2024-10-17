<?php
require_once __DIR__ . "/../lib/handler.php";

class NotAuthenticated implements IHandler {
    public function handle() {
        session_start();
        if(isset($_SESSION['user'])) {
            header("Location: /profile");
            exit;
        }
    }
}
