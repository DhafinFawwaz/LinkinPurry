<?php
require_once __DIR__ . "/../lib/controller.php";
class DetailLowonganJobseekerController extends Controller {
    public function handle(){
        return $this->view("detail-lowongan-jobseeker.php");
    }
}