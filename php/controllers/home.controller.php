<?php
require_once __DIR__ . "/../lib/controller.php";
require_once __DIR__ . "/../models/lowongan.model.php"; 

class HomeController extends Controller {

    public function validatedHandle() {
        session_start();
        /** @var User */
        $user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
        
        return $this->view("home-jobseeker.php", [
            "user" => $user
        ]);
    }
}

