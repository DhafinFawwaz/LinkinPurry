<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <link rel="stylesheet" href="../public/css/home-jobseeker.css">
</head>
<body>
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
                <!-- Tampilkan informasi user jobseeker -->
                <h1><?= isset($user->username) ? $user->username : 'Your Name Here' ?></h1>
                <p>I'm not just an ordinary jobseeker</p>
                <p><?= isset($user->email) ? $user->email : 'Job Title' ?></p>
            </div>
        </div>
    </section>

    <!-- job column (job-filter dan job-picks) -->
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
                <option value="desc">Newest First</option>
                <option value="asc">Oldest First</option>
            </select>
        </div>

        <!-- job picks -->
        <section id="job-picks">
            <div class="job-picks">
                <h2>Top job picks for you</h2>
                <p>Based on your profile and preferences</p>
            </div>

            <div class="job-list">
                <?php if (isset($lowonganList) && !empty($lowonganList)): ?>
                    <?php foreach ($lowonganList as $lowongan): ?>
                        <div class="job-card" onclick="window.location.href='/detail-lowongan-jobseeker?id=<?= $lowongan['lowongan_id'] ?>'">
                            <div class="job-picture">
                                <img src="../public/assets/company_profile.svg" alt="job-picture">
                            </div>
                            <div class="job-card-details">
                                <h3><?= $lowongan['posisi'] ?></h3>
                                <p><?= $lowongan['company_name'] ?></p>
                                <p class="loc"><?= $lowongan['company_location'] ?: 'Location not specified' ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No jobs available at the moment.</p>
                <?php endif; ?>
            </div>

            <div class="pagination">
                <button class="pagination-button prev" disabled>&lt;</button>
                <button class="pagination-button active" data-page="1">1</button>
                <button class="pagination-button" data-page="2">2</button>
                <button class="pagination-button" disabled>...</button>
                <button class="pagination-button" data-page="9">9</button>
                <button class="pagination-button" data-page="10">10</button>
                <button class="pagination-button next">&gt;</button>
            </div>

        </section>
    </section>

    
    <!-- notes -->
    <section id="notes">
        <div class="notes">
            <h2>Job seeker guidance</h2>
            <p>Recomended based on your activity</p>
            <p>Explore our curated guide of expert-led courses, such as how to improve your resume and grow your network, to help you land your next opportunity.</p>
        </div>
    </section>

    <script src="../public/js/home-jobseeker.js"></script>
</body>
</html>

