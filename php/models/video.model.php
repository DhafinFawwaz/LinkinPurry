<?php
require_once __DIR__ . "/file.model.php";

class Video extends File {
    public function getUploadDir() {
        return __DIR__ . "/../uploads/videos/";
    }
    
    public function jsonSerialize(): mixed {
        return [
            "video_path" => $this->path
        ];
    }
}

