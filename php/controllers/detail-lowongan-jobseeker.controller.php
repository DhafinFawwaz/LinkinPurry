<?php
require_once __DIR__ . "/../lib/controller.php";
require_once __DIR__ . "/../models/lowongan.model.php";
require_once __DIR__ . "/../models/lamaran.model.php";
require_once __DIR__ . "/../models/cv.model.php";
require_once __DIR__ . "/../models/video.model.php";

class DetailLowonganJobseekerController extends Controller {
    public function handle() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            return $this->handlePost();
        }
        
        return $this->handleGet();
    }

    public function handleGet() {
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
    }

    public function handlePost() {
        if (!isset($_FILES['cv']) || $_FILES['cv']['error'] === UPLOAD_ERR_NO_FILE) {
            // debug
            $this->redirect("/detail-lowongan-jobseeker?id=" . $_GET['id'] . "&error=missing_cv");
            return;
        }
        
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
            $this->redirect("/detail-lowongan-jobseeker?id=" . $_GET['id'] . "&error=upload_failed");
            return;
        }
        
        $userId = $_SESSION['user']->id;
        $lowonganId = $_GET['id'];
        
        Lamaran::insertLamaran($userId, $lowonganId, $cv, $video);
        
        // debug
        $this->redirect("/detail-lowongan-jobseeker?id=" . $lowonganId . "&success=application_submitted");
    }
}
