<?php
require_once __DIR__ . "/../lib/controller.php";
class AddLowonganController extends Controller {
    public function handle(){

        $user =$this->getCurrentUser();
        $data["user"] = (array)$user;
        $company = Company::fromUser($user);
        $data["company"] = (array)$company;

        if($_SERVER["REQUEST_METHOD"] == "POST") {
            Lowongan::insertLowongan($company->id, $_POST["posisi"], $_POST["deskripsi"], $_POST["jenis_pekerjaan"], $_POST["jenis_lokasi"]);
            $this->redirect("/");
        }

        return $this->view("add-lowongan.php", $data);
    }
}
