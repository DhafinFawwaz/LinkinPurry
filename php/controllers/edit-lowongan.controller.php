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
        $attachment = AttachmentLowongan::getAllAttachmentLowonganByLowonganId($lowongan_id);
        $data["user"] = (array)$user;
        $data["lowongan"] = (array)$lowongan;
        $data["lowongan"]["lowongan_id"] = $lowongan_id;
        $data["lowongan"]["created_at"] = $data["lowongan"]["created_at"]->format('Y-m-d H:i:s');
        $data["attachmentLowongan"] = (array)$attachment;
        $company = Company::fromUser($user);
        $data["company"] = (array)$company;

        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $crud_type = $pathArr[1];
            
            if(!$lowongan->isLowonganExist()) {
                Message::Error("Error", "Vacancy does not exist");
                return $this->redirect("/".$lowongan_id);
            }
            if($crud_type == "edit") {
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

                // attachment
                if(isset($_FILES["attachments"]) && !!$_FILES["attachments"]["name"][0]) {

                    $attachments = [];
                    $names = $_FILES["attachments"]["name"];
                    $tmp_names = $_FILES["attachments"]["tmp_name"];

                    $i = 0;
                    for($i = 0; $i < count(value: $names); $i++) {
                        $name = uniqid() . "_" . basename($names[$i]);
                        $attachments[] = new Attachment($name, $tmp_names[$i]);
                    }
                    Lowongan::deleteAttachmentLowonganByLowonganId($lowongan_id);
                    Lowongan::insertAllAttachmentLowongan($lowongan_id, $attachments);
                }


                Message::Success("Updated Vacancy", "Your vacancy has been updated");
                return $this->redirect("/".$lowongan_id);
            } else if($crud_type == "delete") {
                $lowongan->delete();
                Message::Success("Deleted Vacancy", "Your vacancy has been deleted");
                return $this->redirect("/");
            } else if($crud_type == "close") {
                if(!$lowongan->is_open) {
                    Message::Error("Error", "Vacancy already closed");
                    return $this->redirect("/".$lowongan_id);
                }
                $lowongan->is_open = false;
                $lowongan->save();
                Message::Success("Closed Vacancy", "Your vacancy has been closed");
                return $this->redirect("/".$lowongan_id);
            } else if($crud_type == "open") {
                if($lowongan->is_open) {
                    Message::Error("Error", "Vacancy already opened");
                    return $this->redirect("/".$lowongan_id);
                }
                $lowongan->is_open = true;
                $lowongan->save();
                Message::Success("Opened Vacancy", "Your vacancy has been opened");
                return $this->redirect("/".$lowongan_id);
            } else {
                Message::Error("Error", "Invalid action");
                return $this->redirect("/".$lowongan_id);
            }
        }

        return $this->view("edit-lowongan.php", $data);
    }
}
