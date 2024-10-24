<?php
require_once __DIR__ . "/../lib/controller.php";
class AddLowonganController extends Controller {
    public function handle(){

        $user =$this->getCurrentUser();
        $data["user"] = (array)$user;
        $company = Company::fromUser($user);
        $data["company"] = (array)$company;

        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $attachments = [];
            
            if(isset($_FILES["attachments"]) && !!$_FILES["attachments"]["name"][0]) {
                $names = $_FILES["attachments"]["name"];
                $tmp_names = $_FILES["attachments"]["tmp_name"];

                $i = 0;
                for($i = 0; $i < count($names); $i++) {
                    $type = $this->detectFileType($tmp_names[$i]);
                    if($type != "Image") {
                        Message::Error("Error", "Attachment must be an image");
                        return $this->refreshPage();
                    }

                    $name = uniqid() . "_" . basename($names[$i]);
                    $attachments[] = new Attachment($name, $tmp_names[$i]);
                }
            }
            Lowongan::insertLowongan($company->id, $_POST["posisi"], $_POST["deskripsi"], $_POST["jenis_pekerjaan"], $_POST["jenis_lokasi"], $attachments);
            $this->redirect("/");
        }

        return $this->view("add-lowongan.php", $data);
    }
}
