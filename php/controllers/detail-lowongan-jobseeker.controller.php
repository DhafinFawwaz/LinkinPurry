<?php
require_once __DIR__ . "/../lib/controller.php";
require_once __DIR__ . "/../models/lowongan.model.php";

class DetailLowonganJobseekerController extends Controller {
    public function handle() {
        $lowonganId = $_GET['id'] ?? null;

        if ($lowonganId) {
            $lowonganDetail = Lowongan::getLowonganDetailsById($lowonganId);

            if ($lowonganDetail) {
                return $this->view("detail-lowongan-jobseeker.php", ["lowongan" => $lowonganDetail]);
            }
        }

        // Redirect jika ID lowongan tidak valid
        $this->redirect("/home-jobseeker");
    }
}