<?php
// Data Perusahaan
$company = [
    'nama' => 'NTT DATA, Inc.',
    'lokasi' => 'Jakarta, Jakarta, Indonesia',
    'about' => 'We are renowned for our technical excellence and leading innovations...'
];

// Data Lowongan
$job = [
    'posisi' => 'MS Engineer (L2)',
    'deskripsi' => 'Make an impact with NTT DATA
<br>
<br>
Join a company that is pushing the boundaries of what is possible. We are renowned for our technical excellence and leading innovations, and for making a difference to our clients and society. Our workplace embraces diversity and inclusion – it’s a place where you can grow, belong and thrive.
<br>
<br>
About NTT DATA
<br>
<br>
NTT DATA is a $30+ billion trusted global innovator of business and technology services. We serve 75% of the Fortune Global 100 and are committed to helping clients innovate, optimize and transform for long-term success. We invest over $3.6 billion each year in R&D to help organizations and society move confidently and sustainably into the digital future. As a Global Top Employer, we have diverse experts in more than 50 countries and a robust partner ecosystem of established and start-up companies. Our services include business and technology consulting, data and artificial intelligence, industry solutions, as well as the development, implementation and management of applications, infrastructure, and connectivity. We are also one of the leading providers of digital and AI infrastructure in the world. NTT DATA is part of NTT Group and headquartered in Tokyo.
<br>
<br>
Equal Opportunity Employer
<br>
<br>
NTT DATA is proud to be an Equal Opportunity Employer with a global culture that embraces diversity. We are committed to providing an environment free of unfair discrimination and harassment. We do not discriminate based on age, race, colour, gender, sexual orientation, religion, nationality, disability, pregnancy, marital status, veteran status, or any other protected category. Join our growing global team and accelerate your career with us. Apply today.

',
    'jenis_pekerjaan' => 'Full-time',
    'jenis_lokasi' => 'Hybrid',
    'is_open' => true,
    'created_at' => '1 week ago',
    'updated_at' => '1 week ago',
    'applicants' => 4
];

// Simulasi apakah job seeker sudah melamar
$job_seeker_applied = false; // Ubah ke false jika belum melamar

// Data Lamaran jika sudah melamar
$application = [
    'cv' => '/path/to/cv.pdf',
    'video' => '/path/to/video.mp4',
    'status' => 'waiting',
    'alasan' => 'your application is being reviewed by our team.'
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Details - <?= $job['posisi'] ?></title>

    <link rel="stylesheet" href="../public/css/detail-lowongan.css">
</head>
<body>

    <section id="job-details-wrapper">
        <!-- company profile -->
        <div class="company-container">
            <div class="company-profile">
                <img src="../public/assets/company_profile.svg" alt="company-profile">
                <h2><?= $company['nama'] ?></h2>
            </div>
            <div class="job-details">
                <h2><?= $job['posisi'] ?></h2>
                <p><?= $company['lokasi'] ?> | <?= $job['created_at'] ?></p>
                <!-- <p><?= $company['about'] ?></p> -->
            </div>
            <div class="job-type">
                <p>
                    <img src="../public/assets/bag_icon.svg" class="icon" alt="location-icon">
                    <?= $job['jenis_lokasi'] ?>
                </p>
                <p>
                    <img src="../public/assets/bag_icon.svg" class="icon" alt="job-icon">
                    <?= $job['jenis_pekerjaan'] ?>
                </p>
            </div>
        </div>

        <!-- apply button -->
        <div class="apply-button-action">
            <?php if (!$job['is_open']): ?>
                <div class="apply-closed">
                    <img src="../public/assets/no_accepting.svg" alt="apply-closed">
                    <p>No longer accepting applications</p>
                </div>
            <?php else: ?>
                <?php if ($job_seeker_applied): ?>
                    <a href="#application-status" class="button">View Your Application</a>
                <?php elseif (!$job_seeker_applied): ?>
                    <button id="applyBtn" class="button">Apply</button>
                <?php endif; ?>
            <?php endif; ?>
        </div>
        
        <!-- modal structure -->
        <div id="applyModal" class="modal">
            <div class="modal-content">
                <span class="close" id="closeModal">&times;</span>
                <h2>Apply to <?= $company['nama'] ?></h2>
                <form id="applicationForm" action="submit-application.php" method="post" enctype="multipart/form-data">
                    <!-- resume  -->
                    <div class="form-group">
                        <label for="cv">Resume *
                            <span><br>PDF (2 MB)</span>
                        </label>
                        <div class="upload-box">
                            <div class="file-type">PDF</div>
                            <span id="resumeFileName">No file chosen</span>
                        </div>
                        <button type="button" class="replace-btn" onclick="document.getElementById('cv').click();">Upload resume</button>
                        <input type="file" id="cv" name="cv" accept=".pdf" onchange="updateFileName('cv', 'resumeFileName')">

                        <div id="error-message" class="error-message"></div>
                    </div>

                    <!-- video -->
                    <div class="form-group">
                        <label for="video">Video (Optional)
                            <span><br>MP4 (30 MB)</span>
                        </label>
                        <div class="upload-box">
                            <div class="file-type mp4">MP4</div>
                            <span id="videoFileName">No file chosen</span>
                        </div>
                        <button type="button" class="replace-btn" onclick="document.getElementById('video').click();">Upload video</button>
                        <input type="file" id="video" name="video" accept="video/mp4" onchange="updateFileName('video', 'videoFileName')">
                    </div>

                    <!-- <input type="hidden" name="job_id" value="<?= $job['id'] ?>"> -->
                    <div class="submit-button">
                        <button type="submit" class="button">Submit Application</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- job details -->
        <div class="job-description">
            <h2>About the job</h2>
            <!-- <h2><?= $job['posisi'] ?></h2> -->
            <p><?= $job['deskripsi'] ?></p>
        </div>

        <!-- application status -->
        <?php if ($job_seeker_applied): ?>
            <section id="application-status">
                <h2>Your Application</h2>
                <ul>
                    <li>Status: <?= $application['status'] ?></li>
                    <li>Attachments:
                        <a href="<?= $application['cv'] ?>" target="_blank" class="button-attachment">CV</a>
                        <?php if (!empty($application['video'])): ?>
                            <a href="<?= $application['video'] ?>" target="_blank" class="button-attachment">Video</a>
                        <?php endif; ?>
                    </li>
                    <?php if (!empty($application['alasan'])): ?>
                        <li>Next Step: <?= $application['alasan'] ?></li>
                    <?php endif; ?>
                </ul>
            </section>
        <?php endif; ?>
    </section>
    

    <script src="/public/js/detail-lowongan-jobseeker.js"></script>
</body>
</html>
