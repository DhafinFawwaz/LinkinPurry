<?php
require_once __DIR__ . "/../lib/controller.php";
class LogoutController extends Controller {
    public function handle(){
        session_destroy();
        $this->redirect('/login');
    }

}