<?php
require_once __DIR__ . "/../models/user.model.php";
require_once __DIR__ . "/../models/message.model.php";
require_once __DIR__ . "/../lib/controller.php";
class LoginController extends Controller {
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
            Message::Error("Login Failed", "Please enter the correct data.");
            $this->view("login.php", $data);
            return;
        }


        $hashedPasswordInDB = $userToCheck->password;

        if (!password_verify($submitted_password, $hashedPasswordInDB)) { 
            $data["error"]["password"] = 'Wrong password.';
        } else { 
            if($userToCheck->role == 'company') {
                $company = Company::fromUser($userToCheck);
                $_SESSION['user'] = $company;
            } else {
                $_SESSION['user'] = $userToCheck;
            }
            Message::Success("Login Success", "You have successfully logged in.");
            $this->redirect('/');
        }

        Message::Error("Login Failed", "Please enter the correct data.");

        $this->view("login.php", $data);
    }

}