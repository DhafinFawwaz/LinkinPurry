<?php
require_once __DIR__ . "/../lib/controller.php";
require_once __DIR__ . "/../lib/sanitizer.php";
require_once __DIR__ . "/../models/lamaran.model.php";
require_once __DIR__ . "/../models/user.model.php";
class LamaranController extends Controller {
    public function handle(){
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            return $this->handlePost();
        } else {
            return $this->handleGet();
        }
    }


    public function handlePost() {
        if(!isset($_POST["status"])) {
            $this->redirect("/not-found");
            return;
        }
        if(!isset($_POST["status_reason"])) {
            $this->redirect("/not-found");
            return;
        }
        $user = $this->getCurrentUser();
        if($user->role == 'jobseeker') {
            $this->redirect("/not-found");
            return;
        }
        
        $pathArr = $this->getUrlPath();
        $lowongan_id = $pathArr[0];
        $lamaran_id = $pathArr[1];
        $company = $this->getCurrentUser();
        $lamaran = Lamaran::getLamaranDetailsFromCompany((int)$company->id, (int)$lamaran_id, (int)$lowongan_id);
        if(!$lamaran) {
            $this->redirect("/not-found"); // either not found or not owned by this company
            return;
        }

        $lamaran->status = $_POST["status"];
        $lamaran->status_reason = $_POST["status_reason"];
        $lamaran->save();

        $this->refreshPage();
    }


    public function handleGet() {
        $pathArr = $this->getUrlPath();
        $lowongan_id = $pathArr[0];
        $lamaran_id = $pathArr[1];
        $user = $this->getCurrentUser();
        if($user->role == 'jobseeker') {
            $lamaran = Lamaran::getLamaranDetailsFromJobseeker((int)$user->id, (int)$lamaran_id, (int)$lowongan_id);
        } else {
            $lamaran = Lamaran::getLamaranDetailsFromCompany((int)$user->id, (int)$lamaran_id, (int)$lowongan_id);
        }
        if(!$lamaran) {
            $this->redirect("/not-found"); // either not found or not owned by this company
            return;
        }
            
        $jobseeker = User::getFromLamaranId($lamaran_id);
        $lowongan = Lowongan::getLowonganById($lowongan_id);

        $data = array();
        $data["form"] = $_POST;
        $data["form"]["action"] = "/$lowongan_id/$lamaran_id";
        
        $data["jobseeker"]["username"] = $jobseeker->username;
        $data["jobseeker"]["email"] = $jobseeker->email;
        $data["jobseeker"]["role"] = $jobseeker->role;
        
        $data["lamaran"]["cv_path"] = $lamaran->cv->path;

        if (!is_null($lamaran->video)) {
            $data["lamaran"]["video_path"] = $lamaran->video->path;
        } else {
            $data["lamaran"]["video_path"] = null;
        }

        $data["lamaran"]["status"] = $lamaran->status;
        $data["lamaran"]["status_reason"] = Sanitizer::sanitize($lamaran->status_reason);

        $data["user"]["role"] = $user->role;

        $data["lowongan"]["position"] = $lowongan->posisi;

        return $this->view("detail-lamaran.php", $data);
    }

}
