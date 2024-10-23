<?php
require_once __DIR__ . "/../lib/controller.php";
require_once __DIR__ . "/../models/lowongan.model.php"; 

class HomeJobseekerController extends Controller {
    public function handle() {
        session_start();
        /** @var User */
        $user = isset($_SESSION['user']) ? $_SESSION['user'] : null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search'])) {
            return $this->filterLowongan();
        }

        return $this->view("home-jobseeker.php", [
            "user" => $user
        ]);
    }
    
    public function filterLowongan() {
        $search = $_POST['search'] ?? '';
        $jobTypes = explode(',', $_POST['jobTypes'] ?? '');
        $locationTypes = explode(',', $_POST['locationTypes'] ?? '');
        $sortByDate = $_POST['sortByDate'] ?? 'desc';
        $currentPage = (int)$_POST['page'] ?? 1;
    
        $companyFilter = $_SESSION['user']->username ?? '';
        if (isset($_SESSION['user']) && ($_SESSION['user']->role === 'jobseeker')) {
            $companyFilter = '';
        }
        
        $resultsRows = Lowongan::countFilterLowonganMultiple($search, $jobTypes, $locationTypes, $companyFilter);
        $numberOfPages = (int) ceil($resultsRows / 10);

        // list untuk pagination
        $pagesList = [];
        // start
        if ($numberOfPages >= 1){$pagesList[] = 1;}
        if ($numberOfPages >= 2){$pagesList[] = 2;}
        // mid
        if ($currentPage >= 5){$pagesList[] = "...";}
        if (!in_array($currentPage - 1, $pagesList) && ($currentPage >= 2)){$pagesList[] = $currentPage - 1;}
        if (!in_array($currentPage, $pagesList)){$pagesList[] = $currentPage;}
        if (!in_array($currentPage + 1, $pagesList) && ($currentPage < $numberOfPages)){$pagesList[] = $currentPage + 1;}
        // end
        if ($numberOfPages >= $currentPage + 4){$pagesList[] = "...";}
        if (!in_array($numberOfPages - 1, $pagesList) && ($numberOfPages >= 2)){$pagesList[] = $numberOfPages - 1;}
        if (!in_array($numberOfPages, $pagesList)){$pagesList[] = $numberOfPages;}

        $lowonganList = Lowongan::filterLowonganMultiple($search, $jobTypes, $locationTypes, $sortByDate, $currentPage, $companyFilter);
        if (isset($lowonganList) && !empty($lowonganList)) {
            foreach ($lowonganList as $lowongan) {
                // kondisi login dan guest
                echo "<a href='/{$lowongan['lowongan_id']}' class='job-edit-wrapper'>";
                echo "<div class='job-card'>
                        <div class='job-picture-parent'>
                            <div class='job-picture'>
                                <img src='../public/assets/company_profile.svg' alt='job-picture'>
                            </div>
                            <div class='job-card-details'>
                                <h3>{$lowongan['posisi']}</h3>
                                <p>{$lowongan['company_name']}</p>
                                <p class='loc'>" . ($lowongan['company_location'] ?: 'Location not specified') . "</p>
                            </div>
                        </div>
                    </div>";
                
                if (isset($_SESSION['user']) && ($_SESSION['user']->role === 'company')){
                    echo "
                        <div class='edit-card'>
                            <a class='button' href='/{$lowongan['lowongan_id']}/edit'>Edit</a>
                            <form method='post' action='/{$lowongan['lowongan_id']}/delete'>
                                <button class='button delete-button'>Delete</button>
                            </form>
                        </div>
                    ";
                }
                echo "</a>";
                echo "<hr>";
            }
            
            // tombol pagination
            echo "<div class='pagination'>";
            if ($currentPage === 1){
                echo "<button class='pagination-button prev' disabled>&lt;</button>";
            } else {echo "<button class='pagination-button prev' onclick='filterAndSortJobs($currentPage - 1)'>&lt;</button>";}
            foreach ($pagesList as $pages){
                if ($pages === "..."){
                    echo "<button class='pagination-button' disabled>...</button>";
                } else if ($pages === $currentPage){
                    echo "<button class='pagination-button active' onclick='filterAndSortJobs($pages)'>$pages</button>";
                } else {
                    echo "<button class='pagination-button' onclick='filterAndSortJobs($pages)'>$pages</button>";
                }
            }
            if ($currentPage === $numberOfPages){
                echo "<button class='pagination-button next' disabled>&gt;</button>";
            } else {echo "<button class='pagination-button next' onclick='filterAndSortJobs($currentPage + 1)'>&gt;</button>";}
            echo "</div>";
        } else {
            echo "<p><br>No jobs available at the moment.</p>";
        }
        
    }
}

