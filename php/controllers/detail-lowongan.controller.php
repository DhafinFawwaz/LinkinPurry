<?php
require_once __DIR__ . "/../lib/controller.php";
require_once __DIR__ . "/../models/attachment-lowongan.model.php";
require_once __DIR__ . "/../models/company.model.php";

class DetailLowonganController extends Controller {
    public function handle(){

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

        $company = Company::fromUser($user);
        $data["user"] = (array)$user;
        $data["company"] = (array)$company;
        $data["lowongan"] = (array)$lowongan;
        $data["lowongan"]["lowongan_id"] = $lowongan_id;

        // convert to string
        $data["lowongan"]["created_at"] = $data["lowongan"]["created_at"]->format('Y-m-d H:i:s');
        
        $attachmentLowongan = AttachmentLowongan::getAllAttachmentLowonganByLowonganId($lowongan_id);
        $data["attachmentLowongan"] = (array)$attachmentLowongan;


        return $this->view("detail-lowongan.php", $data);
    }
}
