
<?php
$isAuthenticated = isset($_SESSION['user']);
$currentPage = $_SERVER['REQUEST_URI'];
?>


<header>
    <link rel="stylesheet" href="/public/css/navbar.css">
    <nav>
        <?php if ($isAuthenticated): ?>
            <div class="logo">
                <a href="/">
                    <img src="/public/assets/in_icon.svg" alt="LinkedIn Logo">
                </a>
            </div>
        <?php else: ?>
            <div class="logo">
                <a href="/login">
                    <?php require 'linkinpurry-logo.php'; ?>
                </a>
            </div>
        <?php endif; ?>
        <ul>
            <?php if ($isAuthenticated): ?>
                <!-- Jika sudah login -->
                <?php $isJobseeker = ($_SESSION['user']->role == 'jobseeker'); ?>
                <li class="nav-item <?= $currentPage == '/' ? 'active' : '' ?>">
                    <a href="/">
                        <?php require 'job-icon.php'; ?>
                        <span>Jobs</span>
                    </a>
                </li>

                <?php if ($isJobseeker): ?>
                    <li class="nav-item <?= $currentPage == '/riwayat-lamaran' ? 'active' : '' ?>">
                        <a href="/riwayat-lamaran">
                            <?php require 'application-icon.php'; ?>
                            <span>Applications</span>
                        </a>
                    </li>
                <?php endif; ?>

                <li class="nav-item <?= $currentPage == '/profile' ? 'active' : '' ?>">
                    <a href="/profile">
                        <img src="../public/assets/jobseeker_profile.svg" alt="Me">
                        <span>Me</span>
                    </a>
                </li>
            <?php else: ?>
                <!-- Jika belum login -->
                <li class="nav-item">
                    <a href="/" class="job-icon">
                        <img src="/public/assets/jobs_icon.svg" alt="Jobs">
                        <span>Jobs</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/register" class="btn-join-now">Join Now</a>
                </li>
                <li class="nav-item">
                    <a href="/login" class="btn-sign-in">Login</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
