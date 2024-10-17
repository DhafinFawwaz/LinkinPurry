<?php
require_once __DIR__ . "/file.model.php";

class CV extends File {
    public function getUploadDir() {
        return __DIR__ . "/../uploads/cv/";
    }
    
    public function jsonSerialize(): mixed {
        return [
            "cv_path" => $this->path
        ];
    }
}

