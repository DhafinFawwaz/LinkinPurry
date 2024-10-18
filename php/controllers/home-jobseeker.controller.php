<?php
require_once __DIR__ . "/../lib/controller.php";
require_once __DIR__ . "/../models/lowongan.model.php"; 

class HomeJobseekerController extends Controller {
    public function handle() {
        /** @var User */
        $user = $_SESSION['user'];


        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search'])) {
            return $this->filterLowongan();
        }
    
        $lowonganList = Lowongan::getAllLowongan();
        return $this->view("home-jobseeker.php", [
            "user" => $user,
            "lowonganList" => $lowonganList
        ]);
    }
    
    public function filterLowongan() {
        $search = $_POST['search'] ?? '';
        $jobType = $_POST['jobType'] ?? '';
        $locationType = $_POST['locationType'] ?? '';
        $sortByDate = $_POST['sortByDate'] ?? 'desc';
    
        $lowonganList = Lowongan::filterLowongan($search, $jobType, $locationType, $sortByDate);
        if (isset($lowonganList) && !empty($lowonganList)) {
            foreach ($lowonganList as $lowongan) {
                echo "
                    <div class='job-card' onclick=\"window.location.href='/detail-lowongan-jobseeker?id={$lowongan['lowongan_id']}'\">
                        <div class='job-picture'>
                            <img src='../public/assets/company_profile.svg' alt='job-picture'>
                        </div>
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

