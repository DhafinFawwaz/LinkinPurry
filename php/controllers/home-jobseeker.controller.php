<?php
require_once __DIR__ . "/../lib/controller.php";
require_once __DIR__ . "/../models/lowongan.model.php"; 

class HomeJobseekerController extends Controller {
    public function handle() {
        $lowonganList = Lowongan::getAllLowongan();
        
        // var_dump($lowonganList);
        return $this->view("home-jobseeker.php", ["lowonganList" => $lowonganList]);
    }
}
