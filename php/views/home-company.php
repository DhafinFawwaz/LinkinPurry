<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <!-- css link or something idk -->
</head>
<body>
    <!-- nav -->
    <nav>
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="/profile">Profile</a></li>
            <li><a href="/tambah-lowongan-company">Tambah Lowongan</a></li>
        </ul>
    </nav>

    <!-- search, sort, filter -->
    <section>
        <div>
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
    </section>

    <div class = "job-list">
        <?php
        if (isset($data['lowonganList']) && !empty($data['lowonganList'])) {
            foreach ($data['lowonganList'] as $lowongan) {
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
        ?>
    </div>

    <script src="../public/js/home-company.js"></script>
</body>
</html>