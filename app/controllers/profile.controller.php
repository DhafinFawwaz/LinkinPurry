<?php
require_once __DIR__ . "/../lib/controller.php";
require_once __DIR__ . "/../models/company.php";
class Profile extends Controller {
    public function handle(){
        /** @var User */
        $user = $_SESSION['user'];
        if($user->role === "company") {
            $this->handleCompany($user);
        } else {
            $this->handleUser($user);
        }
    }

    private function handleUser(User $user) {
        $data["form"]["username"] = $user->username;
        $data["form"]["role"] = $user->role;
        
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $user->username = $_POST["username"];
            $data["form"]["username"] = $user->username;
            $user->save();
            $_SESSION['user'] = $user;
        }

        return $this->view("profile.php", $data);
    }

    private function handleCompany(User $user) {
        $company = Company::fromUser($user);

        $data["form"]["username"] = $company->username;
        $data["form"]["location"] = $company->location;
        $data["form"]["about"] = $company->about;
        $data["form"]["role"] = $user->role;
        
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $company->username = $_POST["username"];
            $company->location = $_POST["location"];
            $company->about = $_POST["about"];
            $data["form"]["username"] = $company->username;
            $data["form"]["location"] = $company->location;
            $data["form"]["about"] = $company->about;
            $company->save();
            $_SESSION['user'] = $company;
        }

        return $this->view("profile.php", $data);
    }

}