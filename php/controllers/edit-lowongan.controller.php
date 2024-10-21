<?php
require_once __DIR__ . "/../lib/controller.php";
class EditLowonganController extends Controller {
    public function handle(){
        $pathArr = $this->getUrlPath();
        $lowongan_id = $pathArr[0];

        $user =$this->getCurrentUser();
        $isOwnedByCurrentCompany = Lowongan::isLowonganIdOwnedByCompany($user->id, $lowongan_id);
        if(!$isOwnedByCurrentCompany) {
            $this->redirect("/".$lowongan_id);
            return;
        }

        $lowongan = Lowongan::getLowonganById($lowongan_id);
        $data["user"] = (array)$user;
        $data["lowongan"] = (array)$lowongan;
        $data["lowongan"]["lowongan_id"] = $lowongan_id;
        $data["lowongan"]["created_at"] = $data["lowongan"]["created_at"]->format('Y-m-d H:i:s');
        $company = Company::fromUser($user);
        $data["company"] = (array)$company;

        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $posisi = $_POST["posisi"];
            $deskripsi = $_POST["deskripsi"];
            $jenis_pekerjaan = $_POST["jenis_pekerjaan"];
            $lokasi = $_POST["jenis_lokasi"];
            $lowongan->posisi = $posisi;
            $lowongan->deskripsi = $deskripsi;
            $lowongan->jenis_pekerjaan = $jenis_pekerjaan;
            $lowongan->jenis_lokasi = $lokasi;
            $lowongan->save();
            $data["lowongan"]["posisi"] = $posisi;
            $data["lowongan"]["deskripsi"] = $deskripsi;
            $data["lowongan"]["jenis_pekerjaan"] = $jenis_pekerjaan;
            $data["lowongan"]["jenis_lokasi"] = $lokasi;
            Message::Success("Updated Vacancy", "Your vacancy has been updated");
            return $this->redirect("/".$lowongan_id);
        }

        return $this->view("edit-lowongan.php", $data);
    }
}
