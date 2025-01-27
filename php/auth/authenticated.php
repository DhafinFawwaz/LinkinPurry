<?php
require_once __DIR__ . "/../lib/handler.php";

class Authenticated implements IHandler {
    public function handle() {
        session_start();
        if(!isset($_SESSION['user'])) {
            header("Location: /login");
            exit;
        }
    }
}
