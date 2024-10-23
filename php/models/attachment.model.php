<?php
require_once __DIR__ . "/file.model.php";

class Attachment extends File {
    public function getUploadDir() {
        return "/uploads/attachments/";
    }
    
    public function jsonSerialize(): mixed {
        return [
            "video_path" => $this->fileName
        ];
    }
}

