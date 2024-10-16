<?php
require_once __DIR__ . "/handler.php";

class CompanyOnly implements IHandler {
    public function handle() {
        session_start();
        if(isset($_SESSION['user']) && $_SESSION['user']->role != 'company') {
            header("Location: /profile");
            exit;
        }
    }
}
