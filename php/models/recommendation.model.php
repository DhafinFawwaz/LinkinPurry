<?php
require_once __DIR__ . "/model.php";

class Recommendation extends Model {

    public static function getJobsFor(User $user) {
        // 10 slots

        // get all riwayat lamaran
        // group by company and count them, sort by count
        // for each company, get all newest open job, and at most 6 months old, limit 6
        // limit the result by 6

        // get all open job that is posted at the same day (use updated_at)
        // sort by the amount of lamaran
        // limit 10
        // fill the remaining slots

        // if slot isnt full yet, get all newest job and fill it.

        self::DB()->query("SELECT getRecommendedLowongan($1)", [$user->id]);
        $rows = self::DB()->fetchAll();
        $result = array();
        foreach($rows as $row) {
            $current = trim($row["getrecommendedlowongan"], "()");
            // $fields = explode(",", $current);
            $fields = str_getcsv($current); // to remove extra doublequotes (")
            $lowongan = (array)new Lowongan($fields[0], $fields[1], $fields[2], $fields[3], $fields[4], $fields[5], $fields[6], new DateTime($fields[7]), new DateTime($fields[8]));
            $lowongan["company_name"] = $fields[9];
            $lowongan["company_location"] = $fields[10];
            $result[] = $lowongan;
        }
        return $result;
    }

    public function jsonSerialize(): string {
        return json_encode($this);
    }
}

