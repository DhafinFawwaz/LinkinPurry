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
            <li><a href="#">Profile</a></li>
            <li><a href="#">Tambah Lowongan</a></li>
        </ul>
    </nav>

    <!-- search, sort, filter -->
    <section>
        <div>
            <!-- all functions when? -->
            <input type="text" id="search-input" placeholder="Search job title..." oninput="debouncedSearch()">

            <select id="job-type-filter">
                <option value="">All Job Types</option>
                <option value="full-time">Full Time</option>
                <option value="part-time">Part Time</option>
                <option value="internship">Internship</option>
            </select>

            <select id="location-type-filter">
                <option value="">All Locations</option>
                <option value="on-site">On-Site</option>
                <option value="hybrid">Hybrid</option>
                <option value="remote">Remote</option>
            </select>

            <select id="sort-by-date">
                <option value="desc">Newest</option>
                <option value="asc">Oldest</option>
            </select>
    
            <button onclick="filterAndSortJobs()">Apply</button>
        </div>
    </section>

    <!-- list and pagination -->
</body>
</html>