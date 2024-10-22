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
                        <p>I'm not just an ordinary jobseeker</p>
                        <p><?= isset($data['user']->email) ? $data['user']->email : 'Job Title' ?></p>
                    </div>
                </div>
            </section>
        <?php endif; ?>
    
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
                    <?php if(isset($data['user'])) : ?>
                        <h2>Top job picks for you</h2>
                        <p>Based on your profile and preferences</p>
                    <?php else : ?>
                        <h2>Discover Exciting Career Opportunities</h2>
                        <p>Sign in or create an account to take the next step in your career journey.</p>
                    <?php endif; ?>
                </div>
    
                <div class="job-list"></div>
            </section>
        </section>
    
        
        <!-- notes -->
        <section id="notes">
            <div class="notes">
                <?php if(isset($data['user'])) : ?>
                    <h2>Job seeker guidance</h2>
                    <p>Recomended based on your activity</p>
                    <p>Explore our curated guide of expert-led courses, such as how to improve your resume and grow your network, to help you land your next opportunity.</p>
                <?php else : ?>
                    <h2>Unlock Your Full Potential</h2>
                    <p>Discover More Opportunities by Joining Us</p>
                    <p>Create an account or log in to explore expert-led courses, improve your resume, grow your network, and apply for exciting job opportunities tailored just for you.</p>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <script src="/public/js/home-jobseeker.js"></script>
</body>
</html>

