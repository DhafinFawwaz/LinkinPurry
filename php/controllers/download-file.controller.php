<?php
require_once __DIR__ . "/../lib/controller.php";
require_once __DIR__ . "/../models/lamaran.model.php";

class DownloadFileController extends Controller {
    public function validatedHandle(){
        $user = $this->getCurrentUser();    
        $path = $this->getUrlPath();
        $file_type = $path[1];
        
        $file_path = "/".$path[0]."/".$path[1]."/".$path[2];
        $file_path = urldecode($file_path);

        if($user->role == "company" && !Lamaran::isLamaranFileSubmittedToCompany($user->id, $file_type, $file_path)) {
            http_response_code(403);
            return json_encode(["error" => "You are not authorized to download this file"]);
        } else if ($user->role == "jobseeker" && !Lamaran::isLamaranFileOwnedByUser($user->id, $file_type, $file_path)) {
            http_response_code(403);
            return json_encode(["error" => "You are not authorized to download this file"]);
        }

        $file_path = __DIR__."/../".$file_path;
        if (!file_exists($file_path)) {
            http_response_code(404);
            return json_encode(["error" => "file not found"]);
        }

        header('Content-Description: File Transfer');
        if($file_type == "cv") {
            header('Content-Type: application/pdf');
        } else if($file_type == "videos") {
            header('Content-Type: video/mp4');
        }
        header('Content-Disposition: inline; filename="' . basename($file_path) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file_path));

        readfile($file_path);
        exit;

    }
}
