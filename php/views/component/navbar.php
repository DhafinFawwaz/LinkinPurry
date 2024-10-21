<link rel="stylesheet" href="../../public/css/navbar.css">

<?php
$isAuthenticated = isset($_SESSION['user']); 
$currentPage = basename($_SERVER['PHP_SELF']); 
// var_dump($currentPage);
?>


<header>
    <nav>
        <?php if ($isAuthenticated): ?>
            <div class="logo">
                <a href="/">
                    <img src="../../public/assets/in_icon.svg" alt="LinkedIn Logo">
                </a>
            </div>
        <?php else: ?>
            <div class="logo">
                <a href="/login">
                    <?php require 'linkedin-logo-medium.php'; ?>
                </a>
            </div>
        <?php endif; ?>
        <!-- <div class="logo">
            <a href="">
            <img src="../public/assets/in_icon.svg" alt="LinkedIn Logo">
            </a>
        </div> -->
        <ul>
            <?php if ($isAuthenticated): ?>
                <!-- Jika sudah login -->
                <!-- <li class="nav-item <?= $currentPage == '.php' ? 'active' : '' ?>">
                    <a href="/">
                        <img src="../public/assets/home_icon.svg" alt="Home">
                        <span>Home</span>
                    </a>
                </li> -->
                <li class="nav-item <?= $currentPage == 'jobs.php' ? 'active' : '' ?>">
                    <a href="/">
                        <img src="../public/assets/jobs_icon.svg" alt="Jobs">
                        <span>Jobs</span>
                    </a>
                </li>
                <li class="nav-item <?= $currentPage == 'applications.php' ? 'active' : '' ?>">
                    <a href="/riwayat-lamaran">
                        <img src="../public/assets/application.svg" alt="Applications">
                        <span>Applications</span>
                    </a>
                </li>
                <li class="nav-item <?= $currentPage == 'profile.php' ? 'active' : '' ?>">
                    <a href="/profile">
                        <img src="../public/assets/jobseeker_profile.svg" alt="Me">
                        <span>Me</span>
                    </a>
                </li>
            <?php else: ?>
                <!-- Jika belum login -->
                <li class="nav-item">
                    <a href="/">
                        <img src="../public/assets/jobs_icon.svg" alt="Jobs">
                        <span>Jobs</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/register" class="btn-join-now">Join Now</a>
                </li>
                <li class="nav-item">
                    <a href="/login" class="btn-sign-in">Sign In</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
