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
                <h1>Your Name Here</h1>
                <p>Job Title</p>
                <p>Location</p>
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
                <option value="full-time">Full Time</option>
                <option value="part-time">Part Time</option>
                <option value="internship">Internship</option>
            </select>

            <select id="location-type-filter" onchange="filterAndSortJobs()">
                <option value="">All Locations</option>
                <option value="on-site">On-Site</option>
                <option value="hybrid">Hybrid</option>
                <option value="remote">Remote</option>
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
                <div class="job-card">
                    <div class="job-picture">
                        <img src="../public/assets/company_profile.svg" alt="job-picture">
                    </div>
                    <div class="job-card-details">
                        <h3>Job Title</h3>
                        <p>Company Name</p>
                        <p class="loc">Location</p>
                    </div>
                </div>
                <div class="job-card">
                    <div class="job-picture">
                        <img src="../public/assets/company_profile.svg" alt="job-picture">
                    </div>
                    <div class="job-card-details">
                        <h3>Job Title</h3>
                        <p>Company Name</p>
                        <p class="loc">Location</p>
                    </div>
                </div>
                <div class="job-card">
                    <div class="job-picture">
                        <img src="../public/assets/company_profile.svg" alt="job-picture">
                    </div>
                    <div class="job-card-details">
                        <h3>Job Title</h3>
                        <p>Company Name</p>
                        <p class="loc">Location</p>
                    </div>
                </div>
                <div class="job-card">
                    <div class="job-picture">
                        <img src="../public/assets/company_profile.svg" alt="job-picture">
                    </div>
                    <div class="job-card-details">
                        <h3>Job Title</h3>
                        <p>Company Name</p>
                        <p class="loc">Location</p>
                    </div>
                </div>
                <div class="job-card">
                    <div class="job-picture">
                        <img src="../public/assets/company_profile.svg" alt="job-picture">
                    </div>
                    <div class="job-card-details">
                        <h3>Job Title</h3>
                        <p>Company Name</p>
                        <p class="loc">Location</p>
                    </div>
                </div>
                <div class="job-card">
                    <div class="job-picture">
                        <img src="../public/assets/company_profile.svg" alt="job-picture">
                    </div>
                    <div class="job-card-details">
                        <h3>Job Title</h3>
                        <p>Company Name</p>
                        <p class="loc">Location</p>
                    </div>
                </div>
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

</body>
</html>
