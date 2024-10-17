<?php
require_once __DIR__ . "/../lib/controller.php";
class HomeCompanyController extends Controller {
    public function handle(){
        return $this->view("home-company.php");
    }
}

?>