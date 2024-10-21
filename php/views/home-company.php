<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <link rel="stylesheet" href="../public/css/home-jobseeker.css">
</head>
<body>
    <!-- nav -->
    <section id="navbar">
        <?php include 'component/navbar.php'; ?>
    </section>

    <main>
        <!-- profile -->
        <section id="profile">
            <div class="profile">
                <div class="banner">
                    <img src="../public/assets/banner.svg" alt="banner">
                </div>
                <div class="profile-picture">
                    <img src="../public/assets/jobseeker_profile.svg" alt="profile-picture">
                </div>
                <div class="profile-info">
                    <!-- Tampilkan informasi user company -->
                    <h1><?= isset($data['user']->username) ? $data['user']->username : 'Company Name Here' ?></h1>
                    <p>We're not just a greedy company</p>
                    <p><?= isset($data['user']->email) ? $data['user']->email : 'Company email' ?></p>
                </div>
            </div>
        </section>

        <section id="main-content">
            <!-- search, filter, dan sort -->
            <div id="job-filter" class="filter-sort-container">
                <input type="text" id="search-input" placeholder="Search job title..." oninput="debouncedSearch()">

                <select id="job-type-filter" onchange="filterAndSortJobs()">
                    <option value="">All Job Types</option>
                    <option value="Full Time">Full Time</option>
                    <option value="Part Time">Part Time</option>
                    <option value="Internship">Internship</option>
                </select>

                <select id="location-type-filter" onchange="filterAndSortJobs()">
                    <option value="">All Locations</option>
                    <option value="On-Site">On-Site</option>
                    <option value="Hybrid">Hybrid</option>
                    <option value="Remote">Remote</option>
                </select>

                <select id="sort-by-date" onchange="filterAndSortJobs()">
                    <option value="desc">Newest</option>
                    <option value="asc">Oldest</option>
                </select>
            </div>
    
            <!-- job picks -->
            <section id="job-picks">
                <div class="job-picks">
                    <h2>Open job vacancies</h2>
                </div>
                <div class="job-list"></div>
            </section>
        </section>
    </main>

    <script src="../public/js/home-company.js"></script>
</body>
</html>