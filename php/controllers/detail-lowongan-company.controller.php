<?php
require_once __DIR__ . "/../lib/controller.php";
class DetailLowonganCompanyController extends Controller {
    public function handle(){
        return $this->view("detail-lowongan-company.php");
    }
}
