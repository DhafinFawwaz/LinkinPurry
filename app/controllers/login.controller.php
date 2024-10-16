<?php
require_once __DIR__ . "/../models/user.php";
require_once __DIR__ . "/../lib/controller.php";
class Login extends Controller {
    public function handle(){
        $data = array();
        $data["form"] = $_POST;


        $email = $_POST['email'];
        if(!$email) { $data["error"]["email"] = 'Please enter an email.'; }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $data["error"]["email"] = 'Invalid email.';
        }

        $submitted_password = $_POST['password'];
        if(!$submitted_password) { $data["error"]["password"] = 'Please enter a password.'; }


        $userToCheck = User::getUserByEmail($email);
        if(!$userToCheck) { $data["error"]["email"] = 'Email does not exists.'; }

        if(isset($data["error"])) {
            $this->view("login.php", $data);
            return;
        }


        $hashedPasswordInDB = $userToCheck->password;

        if (!password_verify($submitted_password, $hashedPasswordInDB)) { 
            $data["error"]["password"] = 'Wrong password.';
        } else { 
            $_SESSION['user'] = $userToCheck;
            $this->redirect('/profile');
        }


        $this->view("login.php", $data);
    }

}