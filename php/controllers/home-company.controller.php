<?php
require_once __DIR__ . "/../lib/controller.php";
require_once __DIR__ . "/../models/lowongan.model.php";

class HomeCompanyController extends Controller {
    public function handle(){
        $user = $_SESSION['user'];
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search'])) {
            return $this->filterLowongan();
        }

        return $this->view("home-company.php", [
            "user" => $user,
        ]);
    }

    public function filterLowongan(){
        $search = $_POST['search'] ?? '';
        $jobType = $_POST['jobType'] ?? '';
        $locationType = $_POST['locationType'] ?? '';
        $sortByDate = $_POST['sortByDate'] ?? 'desc';
        $currentPage = (int)$_POST['page'] ?? 1;
        $company = $_SESSION['user']->username;
        
        $resultsRows = Lowongan::countFilterLowongan($search, $jobType, $locationType, $company);
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

        $lowonganList = Lowongan::filterLowongan($search, $jobType, $locationType, $sortByDate, $currentPage, $company);
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

?>