<?php
require_once __DIR__ . "/file.model.php";

class Video extends File {
    public function getUploadDir() {
        return "/uploads/videos/";
    }
    
    public function jsonSerialize(): mixed {
        return [
            "video_path" => $this->fileName
        ];
    }
}

