<?php
require_once __DIR__ . "/../lib/controller.php";
class HomeJobseekerController extends Controller {
    public function handle(){
        return $this->view("home-jobseeker.php");
    }
}