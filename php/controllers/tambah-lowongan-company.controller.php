<?php
require_once __DIR__ . "/../lib/controller.php";
class TambahLowonganCompanyController extends Controller {
    public function handle(){
        return $this->view("tambah-lowongan-company.php");
    }
}

?>