<?php
require_once __DIR__ . "/file.model.php";

class Video extends File {
    private static string $uploadDir = __DIR__ . "/../uploads/videos/";
    public static function setUploadDir(string $dir){
        self::$uploadDir = $dir;
    }
    
    public function jsonSerialize(): mixed {
        return [
            "video_path" => $this->path
        ];
    }
}

