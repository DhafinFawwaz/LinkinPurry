<?php
require_once __DIR__ . "/../lib/controller.php";
class TambahLowonganCompanyController extends Controller {
    public function handle(){
        if ($_SERVER['REQUEST_METHOD'] === 'GET'){
            return $this->view("tambah-lowongan-company.php", [
                "user" => $_SESSION['user']
            ]);
        }
    }
}

?>