<?php
require_once __DIR__ . "/model.php";
require_once __DIR__ . "/video.model.php";
require_once __DIR__ . "/cv.model.php";

class LamaranController extends Model {
    
    private int $lamaran_id;
    private int $user_id;
    private int $lowongan_id;
    private CV $cv;
    private Video $video;
    private string $status = 'waiting'; // 'accepted', 'rejected', 'waiting'
    private string $status_reason;
    private DateTime $created_at;

    public function jsonSerialize(): string {
        return json_encode($this);
    }
}

