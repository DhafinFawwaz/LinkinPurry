<?php
require_once __DIR__ . "/model.php";
require_once __DIR__ . "/video.model.php";
require_once __DIR__ . "/cv.model.php";
require_once __DIR__ . "/attachment.model.php";

class AttachmentLowongan extends Model {
    public int $attachment_id;
    public int $lowongan_id;
    public Attachment $attachment;

    public function __construct(int $attachment_id, int $lowongan_id, Attachment $attachment) {
        $this->attachment_id = $attachment_id;
        $this->lowongan_id = $lowongan_id;
        $this->attachment = $attachment;
    }

    public static function insertAttachmentLowongan(int $lowongan_id, Attachment $attachment) {
        self::DB()->query("INSERT INTO \"Attachment_Lowongan\" (lowongan_id, file_path) VALUES ($1, $2)", [$lowongan_id, $attachment->fileName]);
    }

    public static function getAllAttachmentLowonganByLowonganId(int $lowongan_id) {
        self::DB()->query("SELECT * FROM \"Attachment_Lowongan\" WHERE lowongan_id = $1", [$lowongan_id]);
        return self::DB()->fetchAll();
    }

    public static function deleteAttachmentLowonganByLowonganId(int $lowongan_id) {
        self::DB()->query("DELETE FROM \"Attachment_Lowongan\" WHERE lowongan_id = $1", [$lowongan_id]);
    }
    
    public function jsonSerialize(): string {
        return json_encode($this);
    }
}

