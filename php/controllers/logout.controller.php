<?php
require_once __DIR__ . "/../lib/controller.php";
class LogoutController extends Controller {
    public function validatedHandle(){
        session_destroy();
        Message::Success("Logged Out", "You have been logged out");
        $this->redirect('/login');
    }

}