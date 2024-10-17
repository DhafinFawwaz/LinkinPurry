<?php
require_once __DIR__ . "/model.php";
require_once __DIR__ . "/video.model.php";
require_once __DIR__ . "/cv.model.php";

class Lamaran extends Model {
    
    private int $lamaran_id;
    private int $user_id;
    private int $lowongan_id;
    private CV $cv;
    private Video $video;
    private string $status = 'waiting'; // 'accepted', 'rejected', 'waiting'
    private string $status_reason;
    private DateTime $created_at;

    public function __construct(int $lamaran_id, int $user_id, int $lowongan_id, CV $cv, Video $video, string $status, string $status_reason, DateTime $created_at) {
        $this->lamaran_id = $lamaran_id;
        $this->user_id = $user_id;
        $this->lowongan_id = $lowongan_id;
        $this->cv = $cv;
        $this->video = $video;
        $this->status = $status;
        $this->status_reason = $status_reason;
        $this->created_at = $created_at;
    }

    public static function getLamaranById(int $id) {
        Model::DB()->query("SELECT * FROM \"Lamaran\" WHERE lamaran_id = $1", array($id));
        $res = Model::DB()->fetchRow();
        if(!$res) return null;
        return new Lamaran($res[0], $res[1], $res[2], new CV( $res[3], null), new Video($res[4], null), $res[5], $res[6], new DateTime($res[7]));
    }

    public function getUser() {
        Model::DB()->query("SELECT * FROM \"User\" WHERE user_id= $1", array($this->user_id));
        $res = Model::DB()->fetchRow();
        if(!$res) return null;
        return new User($res[0], $res[1], $res[2], $res[3], $res[4]);
    }

    public function jsonSerialize(): string {
        return json_encode($this);
    }
}

