<?php
require_once __DIR__ . "/../lib/controller.php";
require_once __DIR__ . "/../models/company.model.php";
class ProfileController extends Controller {
    public function handle(){
        /** @var User */
        $user = $_SESSION['user'];
        if($user->role === "company") {
            $this->handleCompany($user);
        } else {
            $this->handleJobseeker($user);
        }
    }

    private function handleJobseeker(User $user) {
        $data["form"]["username"] = $user->username;
        $data["form"]["role"] = $user->role;
        $data["form"]["email"] = $user->email;
        
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $user->username = $_POST["username"];
            $data["form"]["username"] = $user->username;
            $user->save();
            $_SESSION['user'] = $user;
            
            echo "<h1>".htmlspecialchars($data["form"]["username"])."</h1>"; 
            echo "<h2 class='email-title'>".htmlspecialchars($data["form"]["email"])."</h1>"; 
            return;
        }


        return $this->view("profile.php", $data);
    }

    private function handleCompany(User $user) {
        $company = Company::fromUser($user);

        $data["form"]["username"] = $company->username;
        $data["form"]["location"] = $company->location;
        $data["form"]["about"] = $company->about;
        $data["form"]["role"] = $user->role;
        $data["form"]["email"] = $user->email;
        
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $company->username = $_POST["username"];
            $company->location = $_POST["location"];
            $company->about = $_POST["about"];
            $data["form"]["username"] = $company->username;
            $data["form"]["location"] = $company->location;
            $data["form"]["about"] = $company->about;
            $company->save();
            $_SESSION['user'] = $company;
            
            echo "<h1>".htmlspecialchars($data["form"]["username"])."</h1>"; 
            echo "<h2 class='email-title'>".htmlspecialchars($data["form"]["email"])."</h1>"; 
            echo "<p>".htmlspecialchars($data["form"]["location"])."</p>";
            echo "<p>".htmlspecialchars($data["form"]["about"])."</p>";
            return;
        }

        return $this->view("profile.php", $data);
    }

}