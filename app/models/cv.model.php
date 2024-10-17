<?php
require_once __DIR__ . "/file.model.php";

class CV extends File {
    private static string $uploadDir = __DIR__ . "/../uploads/cv/";
    public static function setUploadDir(string $dir){
        self::$uploadDir = $dir;
    }
    
    public function jsonSerialize(): mixed {
        return [
            "cvName" => $this->imageName,
            "cvUrl" => $this->imageUrl
        ];
    }
}

