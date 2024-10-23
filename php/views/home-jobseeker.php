<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <link rel="stylesheet" href="../public/css/home-jobseeker.css">
</head>
<body>
    <section id="navbar">
        <?php include 'component/navbar.php'; ?>
    </section>

    <main>
        <!-- profile -->
        <?php if(isset($data['user'])) : ?>
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
                        <h1><?= isset($data['user']->username) ? $data['user']->username : 'Your Name Here' ?></h1>
                        <?php if ($data['user']->role === 'company') : ?>
                            <p><?= isset($data['user']->about) ? $data['user']->about : 'About' ?></p>
                        <?php endif; ?>
                        <p><?= isset($data['user']->email) ? $data['user']->email : 'Your Email Here' ?></p>
                    </div>
                </div>
            </section>
        <?php endif; ?>
    
        <!-- job column (job-filter dan job-picks) -->
        <section id="main-content">
            <!-- search, filter, dan sort -->
            <div id="job-filter" class="search-container">
                <input type="text" id="search-input" placeholder="Search job title..." oninput="debouncedSearch()">
            </div>

            <!-- job picks -->
            <section id="job-picks">
                <div class="job-picks">
                    <?php if(isset($data['user'])) : ?>
                        <?php if ($data['user']->role === 'jobseeker') : ?>
                            <h2>Top job picks for you</h2>
                            <p>Based on your profile and preferences</p>
                        <?php else : ?>
                            <h2>Open job vacancies</h2>
                            <a class="button" href="/add">Tambah Lowongan</a>
                        <?php endif; ?>
                    <?php else : ?>
                        <h2>Discover Exciting Career Opportunities</h2>
                        <p>Sign in or create an account to take the next step in your career journey.</p>
                    <?php endif; ?>
                </div>
    
                <div class="job-list"></div>
            </section>
        </section>
    
        
        <!-- filter -->
        <?php if (!isset($data['user']) || $data['user']->role === 'jobseeker') : ?>
            <section id="filter">
                <div class="filter-container">
                    <p>Filter</p>
                    <!-- buatkan garis hitam horizontal -->
                    <hr>
                    <div class="filter-group">
                        <button class="collapsible-title" data-filter="job-type-dropdown">
                            <span class="title-text">Job Type</span>
                            <span class="title-icon">></span>
                        </button>
                        <div id="job-type-dropdown" class="dropdown-content">
                            <label><input type="checkbox" class="job-type-checkbox" value="Full Time" onchange="filterAndSortJobs()"> Full Time</label>
                            <label><input type="checkbox" class="job-type-checkbox" value="Part Time" onchange="filterAndSortJobs()"> Part Time</label>
                            <label><input type="checkbox" class="job-type-checkbox" value="Internship" onchange="filterAndSortJobs()"> Internship</label>
                        </div>
                    </div>
                    
                    <div class="filter-group">
                        <button class="collapsible-title" data-filter="location-dropdown">
                            <span class="title-text">Location</span>
                            <span class="title-icon">></span>
                        </button>
                        <div id="location-dropdown" class="dropdown-content">
                            <label><input type="checkbox" class="location-type-checkbox" value="On-Site" onchange="filterAndSortJobs()"> On-Site</label>
                            <label><input type="checkbox" class="location-type-checkbox" value="Hybrid" onchange="filterAndSortJobs()"> Hybrid</label>
                            <label><input type="checkbox" class="location-type-checkbox" value="Remote" onchange="filterAndSortJobs()"> Remote</label>
                        </div>
                    </div>

                    <div class="filter-group">
                        <button class="collapsible-title" data-filter="sort-by-date">
                            <span class="title-text">Sort by Date</span>
                            <span class="title-icon">></span>
                        </button>
                        <div id="sort-by-date" class="dropdown-content">
                            <label><input type="radio" name="sort-by-date" value="desc" onchange="filterAndSortJobs()"> Newest First</label>
                            <label><input type="radio" name="sort-by-date" value="asc" onchange="filterAndSortJobs()"> Oldest First</label>
                        </div>
                    </div>
                </div>
            </section>

        <?php endif; ?>
    </main>

    <script src="/public/js/home-jobseeker.js"></script>
</body>
</html>

