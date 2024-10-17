<?php
require_once __DIR__ . "/../lib/controller.php";
class EditLowonganCompanyController extends Controller {
    public function handle(){
        return $this->view("edit-lowongan-company.php");
    }
}

?>