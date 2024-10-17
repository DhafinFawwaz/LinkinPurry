<?php
require_once __DIR__ . "/model.php";
require_once __DIR__ . "/video.model.php";
require_once __DIR__ . "/cv.model.php";

class Lowongan extends Model {
    public int $lamaran_id;
    public int $company_id;
    public string $posisi;
    public string $deskripsi;
    public string $jenis_pekerjaan;
    public string $jenis_lokasi;
    public bool $is_open;
    public DateTime $created_at;
    public DateTime $updated_at;

    public function __construct(int $lamaran_id, int $company_id, string $posisi, string $deskripsi, string $jenis_pekerjaan, string $jenis_lokasi, bool $is_open, DateTime $created_at, DateTime $updated_at) {
        $this->lamaran_id = $lamaran_id;
        $this->company_id = $company_id;
        $this->posisi = $posisi;
        $this->deskripsi = $deskripsi;
        $this->jenis_pekerjaan = $jenis_pekerjaan;
        $this->jenis_lokasi = $jenis_lokasi;
        $this->is_open = $is_open;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    public static function insertLowongan(int $company_id, string $posisi, string $deskripsi, string $jenis_pekerjaan, string $jenis_lokasi) {
        self::DB()->query("INSERT INTO \"Lowongan\" (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi) VALUES ($1, $2, $3, $4, $5)", [$company_id, $posisi, $deskripsi, $jenis_pekerjaan, $jenis_lokasi]);
    }

    public function jsonSerialize(): string {
        return json_encode($this);
    }
}

