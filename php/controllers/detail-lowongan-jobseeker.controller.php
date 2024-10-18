<?php
require_once __DIR__ . "/../lib/controller.php";
require_once __DIR__ . "/../models/lowongan.model.php";

class DetailLowonganJobseekerController extends Controller {
    public function handle() {
        $lowonganId = $_GET['id'] ?? null;

        if ($lowonganId) {
            $lowonganDetail = Lowongan::getLowonganDetailsById($lowonganId);

            if ($lowonganDetail) {

                $jobseekerHasApplied = Lamaran::jobseekerHasApplied($_SESSION['user']->id, $lowonganId);

                $lamaranStatus = null;
                if($jobseekerHasApplied) {
                    $lamaranStatus = Lamaran::getLamaranDetailbyJobseekerId($_SESSION['user']->id, $lowonganId);
                }

                return $this->view("detail-lowongan-jobseeker.php", [
                    "lowongan" => $lowonganDetail, 
                    "jobseekerHasApplied" => $jobseekerHasApplied, "lamaranStatus" => $lamaranStatus]);
            }
        }

        // Redirect jika ID lowongan tidak valid
        $this->redirect("/home-jobseeker");
    }
}