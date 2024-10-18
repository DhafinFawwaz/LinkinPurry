<?php
require_once __DIR__ . "/model.php";
require_once __DIR__ . "/video.model.php";
require_once __DIR__ . "/cv.model.php";

class Lamaran extends Model {
    
    public int $lamaran_id;
    public int $user_id;
    public int $lowongan_id;
    public CV $cv;
    public Video $video;
    public string $status = 'waiting'; // 'accepted', 'rejected', 'waiting'
    public string $status_reason;
    public DateTime $created_at;

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

    public static function insertLamaran(int $user_id, int $lowongan_id, CV $cv, Video $video) {
        Model::DB()->query("INSERT INTO \"Lamaran\" (user_id, lowongan_id, cv_path, video_path) VALUES ($1, $2, $3, $4)", array($user_id, $lowongan_id, $cv->path, $video->path));
    }

    public function save() {
        Model::DB()->query("UPDATE \"Lamaran\" SET status = $1, status_reason = $2 WHERE lamaran_id = $3", array($this->status, $this->status_reason, $this->lamaran_id));
    }

    public static function fromSqlRow(array $row) {
        return new Lamaran($row[0], $row[1], $row[2], new CV( $row[3], null), new Video($row[4], null), $row[5], $row[6], new DateTime($row[7]));

    }

    public static function getLamaranById(int $id) {
        Model::DB()->query("SELECT * FROM \"Lamaran\" WHERE lamaran_id = $1", array($id));
        $row = Model::DB()->fetchRow();
        if(!$row) return null;
        return self::fromSqlRow(...$row);
    }

    public static function getLamaranDetails(int $companyId, int $lowonganId, int $lamaranId) {
        Model::DB()->query("SELECT * FROM \"Lowongan\" JOIN \"Lamaran\" USING(lowongan_id) WHERE company_id = $1 AND lowongan_id = $2 AND lamaran_id=$3", array($companyId, $lowonganId, $lamaranId));
        $row = Model::DB()->fetchRow();
        if(!$row) return null;
        return new Lamaran($row[9], $row[10], $row[0], new CV( $row[11], null), new Video($row[12], null), $row[13], $row[14], new DateTime($row[15]));
    }

    public static function getRiwayatLamaranByUserId(int $user_id) {
        Model::DB()->query(
            "SELECT l.*, lw.posisi, lw.deskripsi, u.nama as company_name, cd.lokasi as company_location
            FROM \"Lamaran\" l
            JOIN \"Lowongan\" lw ON l.lowongan_id = lw.lowongan_id
            JOIN \"User\" u ON lw.company_id = u.user_id
            LEFT JOIN \"Company_Detail\" cd ON lw.company_id = cd.user_id
            WHERE l.user_id = $1
            ORDER BY l.created_at DESC",
            [$user_id]
        );
        return Model::DB()->fetchAll();
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

