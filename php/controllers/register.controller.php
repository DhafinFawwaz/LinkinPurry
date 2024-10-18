<?php
require_once __DIR__ . "/../lib/controller.php";
require_once __DIR__ . "/../models/user.model.php";
require_once __DIR__ . "/../models/company.model.php";
class Register extends Controller {

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
        if(strlen($submitted_password) < 8) {$data["error"]["password"] = "Atleast 8 characters";}
        if(!self::hasLetterAndNumber($submitted_password)) {$data["error"]["password"] = "At least one letter and one number.";}

        $confirm_password = $_POST['confirmpassword'];
        if(!$confirm_password) { $data["error"]["confirmpassword"] = 'Please confirm your password.'; }
        if($submitted_password !== $confirm_password) { $data["error"]["confirmpassword"] = 'Passwords do not match.'; }

        $location = $_POST['location'] ?? "";
        $about = $_POST['about'] ?? "";
        $role = $_POST['role'] ?? "jobseeker";

        if(isset($data["error"])) {
            $this->view("register.php", $data);
            return;
        }

        $hashedSubmitedPassword = password_hash($submitted_password, PASSWORD_DEFAULT);
        try {
            if($role == "jobseeker") {
                User::insertJobseeker($email, $hashedSubmitedPassword, $username);
            } else {
                User::insertCompany($email, $hashedSubmitedPassword, $username, $location, $about);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            $data["error"]["email"] = 'Email is taken.';
            $this->view("register.php", $data);
            return;
        }

        if($role == 'company') {
            $_SESSION['user'] = Company::getUserByEmail($email);
        } else {
            $_SESSION['user'] = User::getUserByEmail($email);
        }

        $this->redirect("/");
    }

}