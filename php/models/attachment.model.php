<?php
require_once __DIR__ . "/file.model.php";

class Attachment extends File {
    public function getUploadDir() {
        return __DIR__ . "/../uploads/attachments/";
    }
    
    public function jsonSerialize(): mixed {
        return [
            "video_path" => $this->path
        ];
    }
}

