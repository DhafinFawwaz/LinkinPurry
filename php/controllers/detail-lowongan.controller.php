<?php
require_once __DIR__ . "/../lib/controller.php";
require_once __DIR__ . "/../models/attachment-lowongan.model.php";
require_once __DIR__ . "/../models/company.model.php";

class DetailLowonganController extends Controller {
    public function handle(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            return $this->handlePost();
        }
        
        return $this->handleGet();

    }
    
    public function handleGet() {
        $pathArr = $this->getUrlPath();
        $lowongan_id = $pathArr[0];
        $user = $this->getCurrentUser();
        $data = array();

        $lowongan = Lowongan::getLowonganById($lowongan_id);
        if(!$lowongan) {
            $this->redirect("/not-found");
            return;
        }

        if($user->role == 'jobseeker') {
            $data["canEdit"] = false;
        } else if(!Lowongan::isLowonganIdOwnedByCompany($user->id, $lowongan_id)) {
            $data["canEdit"] = false;
        } else {
            $data["canEdit"] = true;
            $lamaranList = Lamaran::getAllLamaranAndUserByLowonganId($lowongan_id);
            $data["lamaranList"] = $lamaranList;
        }

        // data kebutuhan jobseeker
        $data['jobseekerHasApplied'] = Lamaran::jobseekerHasApplied($user->id, $lowongan_id);
        $data['lamaran_id'] = Lamaran::getLamaranIdByUserLowongan($user->id, $lowongan_id);
        $data['lamaranStatus'] = null;
        if($data['jobseekerHasApplied']) {
            $data['lamaranStatus'] = Lamaran::getLamaranDetailbyJobseekerId($user->id, $lowongan_id);
        }

        // companynya dari lowongan
        $company_id = (int)Lowongan::getLowonganDetailsById($lowongan_id)[0]["company_id"];
        $company = Company::fromUser(User::getUserById($company_id));
    
        $data["user"] = (array)$user;
        $data["company"] = (array)$company;
        $data["lowongan"] = (array)$lowongan;
        $data["lowongan"]["lowongan_id"] = $lowongan_id;

        // convert to string
        $data["lowongan"]["created_at"] = $data["lowongan"]["created_at"]->format('Y-m-d H:i:s');
        $data["lowongan"]["updated_at"] = $data["lowongan"]["updated_at"]->format('Y-m-d H:i:s');
        
        $attachmentLowongan = AttachmentLowongan::getAllAttachmentLowonganByLowonganId($lowongan_id);
        $data["attachmentLowongan"] = (array)$attachmentLowongan;

        return $this->view("detail-lowongan.php", $data);
    }

    public function handlePost() {
        $userId = $_SESSION['user']->id;
        $pathArr = $this->getUrlPath();
        $lowongan_id = $pathArr[0];
        // nama unik
        $cvFilename = uniqid() . "_" . basename($_FILES['cv']['name']);
        $cv = new CV($cvFilename, $_FILES['cv']['tmp_name']);
        
        $video = null;
        if (isset($_FILES['video']) && $_FILES['video']['error'] !== UPLOAD_ERR_NO_FILE) {
            $videoFilename = uniqid() . "_" . basename($_FILES['video']['name']);
            $video = new Video($videoFilename, $_FILES['video']['tmp_name']);
        }
    
        try {
            $cv->save();
            if ($video) {
                $video->save();
            }
        } catch (Exception $e) {
            // debug
            $this->redirect("/" . $lowongan_id);;
            return;
        }
        
        Lamaran::insertLamaran($userId, $lowongan_id, $cv, $video);
        
        $this->redirect("/" . $lowongan_id);
    }
}
