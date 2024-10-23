<?php
require_once __DIR__ . "/../lib/controller.php";
class DeleteLowonganController extends Controller {
    public function handle(){

        $pathArr = $this->getUrlPath();
        $lowongan_id = $pathArr[1];
        $user =$this->getCurrentUser();

        $isOwnedByCurrentCompany = Lowongan::isLowonganIdOwnedByCompany($user->id, $lowongan_id);
        if(!$isOwnedByCurrentCompany) {
            Message::Error("Error", "You are not authorized to delete this job");
            $this->redirect("/".$lowongan_id);
            return;
        }

        $lowongan = Lowongan::getLowonganById($lowongan_id);
        Lamaran::deleteAllLamaranCvAndVideosByLowonganId($lowongan_id);
        Lowongan::deleteAttachmentLowonganByLowonganId($lowongan_id);
        $lowongan->delete();
        
        (new HomeJobseekerController())->filterLowongan();
    }
}
