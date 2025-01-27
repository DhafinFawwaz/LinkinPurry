<?php
require_once __DIR__ . "/model.php";
require_once __DIR__ . "/video.model.php";
require_once __DIR__ . "/cv.model.php";

class Lowongan extends Model {
    public int $lowongan_id;
    public int $company_id;
    public string $posisi;
    public string $deskripsi;
    public string $jenis_pekerjaan;
    public string $jenis_lokasi;
    public bool $is_open;
    public DateTime $created_at;
    public DateTime $updated_at;

    public function __construct(int $lamaran_id, int $company_id, string $posisi, string $deskripsi, string $jenis_pekerjaan, string $jenis_lokasi, bool $is_open, DateTime $created_at, DateTime $updated_at) {
        $this->lowongan_id = $lamaran_id;
        $this->company_id = $company_id;
        $this->posisi = $posisi;
        $this->deskripsi = $deskripsi;
        $this->jenis_pekerjaan = $jenis_pekerjaan;
        $this->jenis_lokasi = $jenis_lokasi;
        $this->is_open = $is_open;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    public static function insertLowongan(int $company_id, string $posisi, string $deskripsi, string $jenis_pekerjaan, string $jenis_lokasi, array $attachments) {
        self::DB()->query("INSERT INTO \"Lowongan\" (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi) VALUES ($1, $2, $3, $4, $5) RETURNING lowongan_id", [$company_id, $posisi, $deskripsi, $jenis_pekerjaan, $jenis_lokasi]);

        if(count($attachments) === 0) {
            return;
        }


        $row = self::DB()->fetchRow();
        $lowongan_id = $row[0];
        $values = "";
        $params = [];
        $i = 1;
        foreach ($attachments as $attachment) {
            $attachment->save();
            $values .= "($$i," . "$" . ($i + 1) . "),";
            $params[] = $lowongan_id;
            $params[] = $attachment->getFullPath();
            $i += 2;
        }
        
        $values = rtrim($values, ", ");
        
        self::DB()->query("INSERT INTO \"Attachment_Lowongan\" (lowongan_id, file_path) VALUES $values", $params);
    }

    public static function deleteAttachmentLowonganByLowonganId(int $lowongan_id) {
        try {
            self::DB()->query("SELECT * FROM \"Attachment_Lowongan\" WHERE lowongan_id = $1", [$lowongan_id]);
            $attachments = self::DB()->fetchAll();
            foreach ($attachments as $attachment) {
                $file_path = "." . $attachment['file_path'];
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }
            self::DB()->query("DELETE FROM \"Attachment_Lowongan\" WHERE lowongan_id = $1", [$lowongan_id]);
        } catch (Exception $e) {}
    }

    public static function insertAllAttachmentLowongan(int $lowongan_id, array $attachments) {
        $values = "";
        $params = [];
        $i = 1;
        foreach ($attachments as $attachment) {
            $attachment->save();
            $values .= "($$i," . "$" . ($i + 1) . "),";
            $params[] = $lowongan_id;
            $params[] = $attachment->getFullPath();
            $i += 2;
        }
        
        $values = rtrim($values, ", ");
        
        self::DB()->query("INSERT INTO \"Attachment_Lowongan\" (lowongan_id, file_path) VALUES $values", $params);
    }

    public static function getAllLowongan() {
        self::DB()->query("SELECT l.*, u.nama as company_name, cd.lokasi as company_location 
        FROM \"Lowongan\" l 
        JOIN \"User\" u ON l.company_id = u.user_id
        LEFT JOIN \"Company_Detail\" cd ON l.company_id = cd.user_id
        WHERE l.is_open = true 
        ORDER BY l.created_at DESC", []);
        return self::DB()->fetchAll();
    }

    public static function getLowonganDetailsById($id) {
        self::DB()->query(
            "SELECT l.*, u.nama as company_name, cd.lokasi as company_location
            FROM \"Lowongan\" l
            JOIN \"User\" u ON l.company_id = u.user_id
            LEFT JOIN \"Company_Detail\" cd ON l.company_id = cd.user_id
            WHERE l.lowongan_id = $1", 
            [$id]
        );
        return self::DB()->fetchAll();
    }

    // untuk pagination
    public static function countFilterLowonganMultiple($search, $jobTypes, $locationTypes, $company) {
        $query = "SELECT COUNT(*) AS total
        FROM \"Lowongan\" l
        JOIN \"User\" u ON l.company_id = u.user_id";
        
        $params = [];
        $index = 1; 
    
        if (!empty($company)) {
            $query .= " WHERE u.nama = $" . $index;
            $params[] = $company;
            $index++;
        } else {
            $query .= " WHERE l.is_open = true";
        }
    
        if (!empty($search)) {
            $query .= " AND l.posisi ILIKE '%' || $" . $index . " || '%'";
            $params[] = $search;
            $index++;
        }
    
        if (!empty($jobTypes[0])) {
            // var_dump($jobTypes);
            $placeholders = array_map(function($i) { return "$".$i; }, range($index, $index + count($jobTypes) - 1));
            // var_dump($placeholders);
            $query .= " AND l.jenis_pekerjaan IN (" . implode(',', $placeholders) . ")";
            $params = array_merge($params, $jobTypes);
            $index += count($jobTypes);
        }
    
        if (!empty($locationTypes[0])) {
            $placeholders = array_map(function($i) { return "$".$i; }, range($index, $index + count($locationTypes) - 1));
            $query .= " AND l.jenis_lokasi IN (" . implode(',', $placeholders) . ")";
            $params = array_merge($params, $locationTypes);
            $index += count($locationTypes);
        }
    
        self::DB()->query($query, $params);
        return self::DB()->fetchAll()[0]['total'];
    }
    
    public static function filterLowonganMultiple($search, $jobTypes, $locationTypes, $sortByDate, $currentPage, $company) {
        $query = "SELECT l.*, u.nama as company_name, cd.lokasi as company_location
                  FROM \"Lowongan\" l
                  JOIN \"User\" u ON l.company_id = u.user_id
                  LEFT JOIN \"Company_Detail\" cd ON l.company_id = cd.user_id";
        
        $params = [];
        $index = 1; 
    
        if (!empty($company)) {
            $query .= " WHERE u.nama = $" . $index;
            $params[] = $company;
            $index++;
        } else {
            $query .= " WHERE l.is_open = true";
        }
    
        if (!empty($search)) {
            $query .= " AND l.posisi ILIKE '%' || $" . $index . " || '%'";
            $params[] = $search;
            $index++;
        }
    
        if (!empty($jobTypes[0])) {
            // var_dump($jobTypes);
            $placeholders = array_map(function($i) { return "$".$i; }, range($index, $index + count($jobTypes) - 1));
            // var_dump($placeholders);
            $query .= " AND l.jenis_pekerjaan IN (" . implode(',', $placeholders) . ")";
            $params = array_merge($params, $jobTypes);
            $index += count($jobTypes);
        }
    
        if (!empty($locationTypes[0])) {
            $placeholders = array_map(function($i) { return "$".$i; }, range($index, $index + count($locationTypes) - 1));
            $query .= " AND l.jenis_lokasi IN (" . implode(',', $placeholders) . ")";
            $params = array_merge($params, $locationTypes);
            $index += count($locationTypes);
        }
    
        $query .= " ORDER BY l.created_at " . ($sortByDate === 'asc' ? 'ASC' : 'DESC');
        
        // untuk pagination
        // var_dump($currentPage); 
        $limit = 10;
        $offset = ($currentPage - 1) * $limit;
        // var_dump($limit);
        // var_dump($offset);
        $query .= " LIMIT $limit OFFSET $offset";
    
        self::DB()->query($query, $params);
        return self::DB()->fetchAll();
    }    

    public static function getLowonganById(int $id) {
        self::DB()->query("SELECT * FROM \"Lowongan\" WHERE lowongan_id = $1", [$id]);
        $row = self::DB()->fetchRow();
        if(!$row) return null;
        $row[6] = Model::pgBoolToPhpBool($row[6]);
        return new Lowongan($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], new DateTime($row[7]), new DateTime($row[8]));
    }

    public static function isLowonganIdOwnedByCompany(int $company_id, int $lowongan_id) {
        self::DB()->query("SELECT * FROM \"Lowongan\" WHERE company_id = $1 AND lowongan_id = $2", [$company_id, $lowongan_id]);
        $res = self::DB()->fetchRow();
        return !!$res;
    }

    public function save() {
        self::DB()->query("UPDATE \"Lowongan\" SET posisi = $1, deskripsi = $2, jenis_pekerjaan = $3, jenis_lokasi = $4, is_open = $5 WHERE lowongan_id = $6", [$this->posisi, $this->deskripsi, $this->jenis_pekerjaan, $this->jenis_lokasi, Model::phpBoolToPgBool($this->is_open), $this->lowongan_id]);
    }

    public function isLowonganExist() {
        self::DB()->query("SELECT * FROM \"Lowongan\" WHERE lowongan_id = $1", [$this->lowongan_id]);
        return !!self::DB()->fetchRow();
    }
    public function isLowonganHasLamaran() {
        self::DB()->query("SELECT * FROM \"Lamaran\" WHERE lowongan_id = $1", [$this->lowongan_id]);
        return !!self::DB()->fetchRow();
    }

    public function delete() {
        self::DB()->query("DELETE FROM \"Lowongan\" WHERE lowongan_id = $1", [$this->lowongan_id]);
    }

    public function jsonSerialize(): string {
        return json_encode($this);
    }
}

