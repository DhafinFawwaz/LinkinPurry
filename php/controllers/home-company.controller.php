<?php
require_once __DIR__ . "/../lib/controller.php";
require_once __DIR__ . "/../models/lowongan.model.php";

class HomeCompanyController extends Controller {
    public function handle(){
        $user = $_SESSION['user'];
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search'])) {
            return $this->filterLowongan();
        }

        $lowonganList = Lowongan::filterLowongan('', '', '', 'desc', 1, $user->username);
        return $this->view("home-company.php", [
            "user" => $user,
            "lowonganList" => $lowonganList
        ]);
    }

    public function filterLowongan(){
        $search = $_POST['search'] ?? '';
        $jobType = $_POST['jobType'] ?? '';
        $locationType = $_POST['locationType'] ?? '';
        $sortByDate = $_POST['sortByDate'] ?? 'desc';
        $company = $_SESSION['user']->username;
        
        $lowonganList = Lowongan::filterLowongan($search, $jobType, $locationType, $sortByDate, 1, $company);
        if (isset($lowonganList) && !empty($lowonganList)) {
            foreach ($lowonganList as $lowongan) {
                echo "
                    <div class='job-card'>
                        <div class='job-card-details'>
                            <h3>{$lowongan['posisi']}</h3>
                            <p>{$lowongan['company_name']}</p>
                            <p class='loc'>" . ($lowongan['company_location'] ?: 'Location not specified') . "</p>
                        </div>
                    </div>
                ";
            }
        } else {
            echo "<p><br>No jobs available at the moment.</p>";
        }
    }
}

?>