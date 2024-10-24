<?php
require_once __DIR__ . "/model.php";
require_once __DIR__ . "/video.model.php";
require_once __DIR__ . "/cv.model.php";

class Lamaran extends Model {
    
    public int $lamaran_id;
    public int $user_id;
    public int $lowongan_id;
    public CV $cv;
    public ?Video $video;
    public string $status = 'waiting'; 
    public string $status_reason;
    public DateTime $created_at;

    public function __construct(int $lamaran_id, int $user_id, int $lowongan_id, CV $cv, ?Video $video, string $status, string $status_reason, DateTime $created_at) {
        $this->lamaran_id = $lamaran_id;
        $this->user_id = $user_id;
        $this->lowongan_id = $lowongan_id;
        $this->cv = $cv;
        $this->video = $video;
        $this->status = $status;
        $this->status_reason = $status_reason;
        $this->created_at = $created_at;
    }


    public static function insertLamaran(int $user_id, int $lowongan_id, CV $cv, ?Video $video = null) {
        $videoPath = $video ? $video->getFullPath() : null;
    
        Model::DB()->query(
            "INSERT INTO \"Lamaran\" (user_id, lowongan_id, cv_path, video_path) 
            VALUES ($1, $2, $3, $4)", 
            array(
                $user_id, 
                $lowongan_id, 
                $cv->getFullPath(), 
                $videoPath
            )
        );
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

    public static function getLamaranDetailsFromJobseeker(int $userId, int $lamaranId, int $lowonganId) {
        Model::DB()->query("SELECT * FROM \"User\" JOIN \"Lamaran\" USING(user_id) JOIN \"Lowongan\" USING(lowongan_id) WHERE user_id = $1 AND lamaran_id=$2 AND lowongan_id = $3", array($userId, $lamaranId, $lowonganId));
        $row = Model::DB()->fetchRow();
        if(!$row) return null;
    
        $video = null;
        if ($row[8]) {
            $video = new Video($row[8], null);
        }
    
        return new Lamaran($row[6], $row[1], $row[0], new CV($row[7], null), $video, $row[9], $row[10] ?? '', new DateTime($row[11]));
    }

    public static function getLamaranDetailsFromCompany(int $companyId, int $lamaranId, int $lowonganId) {
        Model::DB()->query("SELECT * FROM \"Company_Detail\" JOIN \"Lowongan\" ON \"Company_Detail\".user_id=\"Lowongan\".company_id JOIN \"Lamaran\" USING(lowongan_id) WHERE company_id=$1 AND lamaran_id=$2 AND lowongan_id=$3", array($companyId, $lamaranId, $lowonganId));
        $row = Model::DB()->fetchRow();
        if(!$row) return null;

        $video = null;
        if ($row[15]) {
            $video = new Video($row[15], null);
        }

        if(!$row[17]) $row[17] = "";
        return new Lamaran($row[12], -1, $row[0], new CV( $row[14], null), $video, $row[16], $row[17], new DateTime($row[18]));
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

    public static function getLamaranIdByUserLowongan(int $user_id, int $lowongan_id) {
        Model::DB()->query(
            "SELECT lamaran_id 
             FROM \"Lamaran\" 
             WHERE user_id = $1 AND lowongan_id = $2", 
             array($user_id, $lowongan_id)
        );
        $row = Model::DB()->fetchRow();
        if (!$row) return null;
        
        return $row[0];
    }
    
    public static function jobseekerHasApplied($job_seeker_id, $lowongan_id) {
        self::DB()->query(
            "SELECT * FROM \"Lamaran\" 
            WHERE user_id = $1 AND lowongan_id = $2",
            [$job_seeker_id, $lowongan_id]
        );
        return self::DB()->fetchAll();
    }

    public static function getLamaranDetailbyJobseekerId($job_seeker_id, $lowongan_id) {
        self::DB()->query(
            "SELECT * FROM \"Lamaran\" 
            WHERE user_id = $1 AND lowongan_id = $2",
            [$job_seeker_id, $lowongan_id]
        );
        return self::DB()->fetchAll();
    }

    public static function getAllLamaranByLowonganId($lowongan_id) {
        self::DB()->query(
            "SELECT * FROM \"Lamaran\" 
            WHERE lowongan_id = $1",
            [$lowongan_id]
        );
        return self::DB()->fetchAll();
    }

    public static function getAllLamaranAndUserByLowonganId($lowongan_id) {
        self::DB()->query(
            "SELECT *
            FROM \"Lamaran\" l
            JOIN \"User\" u ON l.user_id = u.user_id
            WHERE lowongan_id = $1",
            [$lowongan_id]
        );
        return self::DB()->fetchAll();
    }

    public static function isLamaranFileOwnedByUser($user_id, $file_type, $file_path) {
        if($file_type == "videos") $file_type = "video";
        self::DB()->query(
            "SELECT * FROM \"Lamaran\" l
            JOIN \"User\" u ON l.user_id = u.user_id
            WHERE u.user_id = $1 AND l.".$file_type."_path = $2",
            [$user_id, $file_path]
        );
        $rows = self::DB()->fetchRow();
        if(empty($rows)) return false;
        return true;
    }
    public static function isLamaranFileSubmittedToCompany($company_id, $file_type, $file_path) {
        if($file_type == "videos") {
            $file_type = "video";
        }
        self::DB()->query(
            "SELECT * FROM \"Lamaran\" l
            JOIN \"Lowongan\" lw ON l.lowongan_id = lw.lowongan_id
            WHERE lw.company_id = $1 AND l.".$file_type."_path = $2",
            [$company_id, $file_path]
        );
        $rows = self::DB()->fetchRow();
        if(empty($rows)) return false;
        return true;
    }


    public function jsonSerialize(): string {
        return json_encode($this);
    }
}

