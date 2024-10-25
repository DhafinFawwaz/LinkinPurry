<?php
require_once __DIR__ . "/../lib/controller.php";
require_once __DIR__ . "/../models/lowongan.model.php"; 

class SearchController extends Controller {

    public function validatedHandle() {
        if (isset($_GET['search'])) {
            return $this->filterLowongan();
        } else echo "";
    }
    
    public function filterLowongan() {

        session_start();
        $search = $_GET['search'] ?? '';
        $jobTypes = explode(',', $_GET['jobTypes'] ?? '');
        $locationTypes = explode(',', $_GET['locationTypes'] ?? '');
        $sortByDate = $_GET['sortByDate'] ?? 'desc';
        $currentPage = (int)($_GET['page'] ?? 1);
    
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
                $lowongan_id = $lowongan['lowongan_id'];
                // kondisi login dan guest
                echo "<div id=$lowongan_id class='job-edit-wrapper'>";
                echo "  <a class='job-card' href='/{$lowongan['lowongan_id']}'>
                            <div class='job-picture-parent'>
                                <div class='job-picture'>
                                    <img src='../public/assets/company_profile.svg' alt='job-picture'>
                                </div>
                                <div class='job-card-details'>
                                    <h3>" . htmlspecialchars($lowongan['posisi']) . "</h3>
                                    <p>" . htmlspecialchars($lowongan['company_name']) . " (" . $lowongan['jenis_pekerjaan'] . ")" ."</p>
                                    <p class='loc'>" . htmlspecialchars($lowongan['company_location']) . " (" . $lowongan['jenis_lokasi'] . ")" . "</p>
                                </div>
                            </div>
                        </a>";
                
                if (isset($_SESSION['user']) && ($_SESSION['user']->role === 'company')){
                    echo "
                        <div class='edit-card'>
                            <div class='icon-button dropdown-hoverable'>
                        ";
                    echo '      <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 1024 1024"><path fill="black" d="M176 416a112 112 0 1 1 0 224a112 112 0 0 1 0-224m336 0a112 112 0 1 1 0 224a112 112 0 0 1 0-224m336 0a112 112 0 1 1 0 224a112 112 0 0 1 0-224"></path></svg>';
                    echo "        
                            
                            </div>
                            <div class='list-dropdown-content'>
                                <a class='button-dropdown-parent' href='/{$lowongan['lowongan_id']}/edit'>
                                    <div>
                                        <svg width='1em' height='1em' viewBox='0 0 24 24'><path fill='black' d='M3 21v-4.25L16.2 3.575q.3-.275.663-.425t.762-.15t.775.15t.65.45L20.425 5q.3.275.438.65T21 6.4q0 .4-.137.763t-.438.662L7.25 21zM17.6 7.8L19 6.4L17.6 5l-1.4 1.4z'></path></svg>
                                    </div>
                                    <div>Edit</div>
                                </a>
                                <hr>
                                <button onclick='deleteJob($lowongan_id)' class='button-dropdown'>
                                    <div>
                                        <svg xmlns='http://www.w3.org/2000/svg' width='1em' height='1em' viewBox='0 0 24 24'><path fill='black' d='M7 21q-.825 0-1.412-.587T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.587 1.413T17 21zm2-4h2V8H9zm4 0h2V8h-2z'></path></svg>
                                    </div>
                                    <div>Delete</div>
                                </button>
                            </div>

                        </div>
                    ";
                }
                ///{$lowongan['lowongan_id']}/delete
                echo "<hr></div>";
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

