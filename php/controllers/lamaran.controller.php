<?php
require_once __DIR__ . "/../lib/controller.php";
require_once __DIR__ . "/../models/lamaran.model.php";
require_once __DIR__ . "/../models/user.model.php";
class LamaranController extends Controller {
    public function handle(){

        $pathArr = $this->getUrlPath();
        $lowongan_id = $pathArr[0];
        $lamaran_id = $pathArr[1];

        $company = $this->getCurrentUser();

        $lamaran = Lamaran::getLamaranDetails($company->id, $lowongan_id, $lamaran_id);
        if(!$lamaran) {
            $this->redirect("/not-found"); // either not found or not owned by this company
            return;
        }
            
        $jobseeker = $lamaran->getUser();

        $data = array();
        $data["form"] = $_POST;
        $data["form"]["action"] = "/$lowongan_id/$lamaran_id";
        
        $data["jobseeker"]["username"] = $jobseeker->username;
        $data["jobseeker"]["email"] = $jobseeker->email;
        
        $data["lamaran"]["cv_path"] = $lamaran->cv->path;
        $data["lamaran"]["video_path"] = $lamaran->video->path;

        $data["lamaran"]["status"] = $lamaran->status;
        $data["lamaran"]["status_reason"] = $lamaran->status_reason;

        return $this->view("detail-lamaran.php", $data);
    }

}

// Pada halaman ini, tampilkan:
// Data job seeker yang melamar: nama dan email
// Attachment lamaran:
// CV. Tampilkan dalam bentuk PDF embed, terserah dengan metode apa saja.
// Video perkenalan (jika ada). Tampilkan dalam bentuk video player.
// Status lamaran, beserta alasan/tindak lanjutnya (jika ada)
// Pada halaman ini juga, company dapat melakukan approve/reject serta memberikan alasan/tindak lanjutnya hanya untuk lamaran yang masih berstatus waiting. Alasan/tindak lanjut ini dalam bentuk rich text HTML.
