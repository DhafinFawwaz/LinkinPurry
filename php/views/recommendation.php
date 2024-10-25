<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recommendation</title>
    <meta name="description" content="List recommended of jobs">


    <link rel="stylesheet" href="/public/css/home-jobseeker.css">
</head>
<body>
    <?php include 'component/toaster.php'; ?>
    <?php include 'component/navbar.php'; ?>

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
                        <p><?= isset($data['user']->email) ? $data['user']->email : 'Your Email Here' ?></p>
                        <?php if ($data['user']->role === 'company') : ?>
                            <p><?= isset($data['user']->about) ? $data['user']->about : 'About' ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>
    
        <!-- job column (job-filter dan job-picks) -->
        <section id="main-content">

            <!-- job picks -->
            <section id="job-picks">
                <div class="job-picks">
                    <?php if(isset($data['user'])) : ?>
                        <?php if ($data['user']->role === 'jobseeker') : ?>
                            <h2>Top job picks for you</h2>
                            <p>Based on your profile and preferences</p>
                        <?php else : ?>
                            <h2>Open job vacancies</h2>
                            <a class="button" href="/add">Add Job</a>
                        <?php endif; ?>
                    <?php else : ?>
                        <h2>Discover Exciting Career Opportunities</h2>
                        <p>Sign in or create an account to take the next step in your career journey.</p>
                    <?php endif; ?>
                </div>
    
                <div class="job-list">
                    <?php 
                        if(empty($data["lowonganList"])) echo "<p><br>No recommended jobs available at the moment.</p>";
                    ?>
                    <?php foreach ($data["lowonganList"] as $lowongan) : ?>
                        <div id=<?= $lowongan["lowongan_id"]; ?> class='job-edit-wrapper'>
                            <a class='job-card' href='/<?= $lowongan["lowongan_id"]; ?>'>
                                <div class='job-picture-parent'>
                                    <div class='job-picture'>
                                        <img src='/public/assets/company_profile.svg' alt='job-picture'>
                                    </div>
                                    <div class='job-card-details'>
                                        <h3><?= htmlspecialchars($lowongan["posisi"]); ?></h3>
                                        <p><?= htmlspecialchars($lowongan["company_name"]); ?></p>
                                        <p class='loc'><?= isset($lowongan["company_name"]) ? htmlspecialchars($lowongan["company_location"]) : "Location not specified"; ?></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <hr>
                    <?php endforeach; ?>
                </div>
            </section>
        </section>

    </main>

</body>
</html>

