<?php
require_once __DIR__ . "/../lib/controller.php";
class Register extends Controller {

    // set this from .env
    private static $authSecret = '123';
    public static function setAuthSecret(string $newAuthSecret) {
        Register::$authSecret = $newAuthSecret;
    }

    private static function hasLetterAndNumber($str) { 
        return preg_match('/[a-zA-Z]/', $str) 
            && preg_match('/[0-9]/', $str); 
    } 

    public function handle(){
        $data["form"] = $_POST;
        $username = $_POST['username'];
        if(!$username) { $data["error"]["username"] = 'Please enter a username.'; }

        $email = $_POST['email'];
        if(!$email) { $data["error"]["email"] = 'Please enter an email.'; }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $data["error"]["email"] = 'Invalid email.';
        }

        $submitted_password = $_POST['password'];
        if(!$submitted_password) { $data["error"]["password"] = 'Please enter a password.'; }
        if(strlen($submitted_password) < 8) {$data["error"]["password"] = "Password atleast 8 characters";}
        if(!Register::hasLetterAndNumber($submitted_password)) {$data["error"]["password"] = "Password must contain number and letter.";}

        $role = "jobseeker";

        if(isset($data["error"])) {
            $this->view("register.php", $data);
            return;
        }

        $hashedSubmitedPassword = password_hash($submitted_password, PASSWORD_DEFAULT);
        try {
            User::insertUser($email, $hashedSubmitedPassword, $role, $username);
        } catch (Exception $e) {
            $data["error"]["email"] = 'Email is taken.';
            $this->view("register.php", $data);
            return;
        }

        $this->redirect("login");
    }

}