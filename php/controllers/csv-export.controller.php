<?php
require_once __DIR__ . "/../lib/controller.php";
require_once __DIR__ . "/../models/attachment-lowongan.model.php";
class CSVExportController extends Controller {
    function array_to_csv_download($array, $filename = "export.csv", $delimiter=";") {
        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename="'.$filename.'";');
        $f = fopen('php://output', 'w');
        foreach ($array as $line) {
            fputcsv($f, $line, $delimiter);
        }
    }  

    public function validatedHandle(){
        $pathArr = $this->getUrlPath();
        $lowongan_id = $pathArr[2];
        if($lowongan_id == null) {
            http_response_code(400);
            return json_encode(["error" => "lowongan_id is required"]);
        }

        $user = $this->getCurrentUser();

        if(!Lowongan::isLowonganIdOwnedByCompany($user->id, $lowongan_id)) {
            http_response_code(403);
            return json_encode(["error" => "lowongan_id is not owned by this company"]);
        }
        $lowongan = Lowongan::getLowonganById($lowongan_id);
        
        $lamaranList = Lamaran::getAllLamaranAndUserByLowonganId($lowongan_id);
        $arr = array();
        $arr[] = array("Nama", "Pekerjaan yang dilamar", "Tanggal melamar", "URL CV", "URL Video", "Status lamaran");
        foreach($lamaranList as $lamaran) {
            $arr[] = array(
                $lamaran["nama"],
                $lowongan->posisi,
                $lamaran["created_at"],
                $_SERVER["HTTP_HOST"].$lamaran["cv_path"],
                $_SERVER["HTTP_HOST"].$lamaran["video_path"],
                $lamaran["status"]
            );
        }

        $this->array_to_csv_download(
            $arr,
            "export.csv"
        );

    }
}
