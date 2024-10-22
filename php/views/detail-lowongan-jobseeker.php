<?php
if (isset($data['lowongan'])) {
    $data_lowongan = $data['lowongan'][0];
    $lowongan_id = $data_lowongan['lowongan_id'];
    $company_name = $data_lowongan['company_name'];
    $company_location = $data_lowongan['company_location'] ?: 'Location not specified';
    $posisi = $data_lowongan['posisi'];
    $deskripsi = $data_lowongan['deskripsi'];
    $jenis_pekerjaan = $data_lowongan['jenis_pekerjaan'];
    $jenis_lokasi = $data_lowongan['jenis_lokasi'];
    $is_open = $data_lowongan['is_open'] === 't' ? 'Open' : 'Closed';
    $created_at = date("F j, Y", strtotime($data_lowongan['created_at']));
    $updated_at = date("F j, Y", strtotime($data_lowongan['updated_at']));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Details - <?= htmlspecialchars($posisi) ?></title>

    <link rel="stylesheet" href="../public/css/detail-lowongan.css">
</head>
<body>
    <section id="navbar">
        <?php include 'component/navbar.php'; ?>
    </section>
    
    <section id="job-details-wrapper">
        <!-- company profile -->
        <div class="company-container">
            <div class="company-profile">
                <img src="../public/assets/company_profile.svg" alt="company-profile">
                <h2><?= htmlspecialchars($company_name) ?></h2>
            </div>
            <div class="job-details">
                <h2><?= htmlspecialchars($posisi) ?></h2>
                <p><?= htmlspecialchars($company_location) ?> | <?= htmlspecialchars($created_at) ?></p>
                <!-- <p><?= htmlspecialchars($company['about']) ?></p> -->
            </div>
            <div class="job-type">
                <p>
                    <img src="../public/assets/bag_icon.svg" class="icon" alt="location-icon">
                    <?= htmlspecialchars($jenis_lokasi) ?>
                </p>
                <p>
                    <img src="../public/assets/bag_icon.svg" class="icon" alt="job-icon">
                    <?= htmlspecialchars($jenis_pekerjaan) ?>
                </p>
            </div>
        </div>

        <!-- apply button -->
        <div class="apply-button-action">
            <?php if (!$is_open): ?>
                <div class="apply-closed">
                    <img src="../public/assets/no_accepting.svg" alt="apply-closed">
                    <p>No longer accepting applications</p>
                </div>
            <?php else: ?>
                <?php if ($data['jobseekerHasApplied']): ?>
                    <a href="/<?= $lowongan_id ?>/<?= $data['riwayatLamaran'][0]['lamaran_id'] ?>" class="button">View Your Application</a>
                <?php elseif (!$data['jobseekerHasApplied']): ?>
                    <button id="applyBtn" class="button">Apply</button>
                <?php endif; ?>
            <?php endif; ?>
        </div>
        
        <!-- modal structure -->
        <div id="applyModal" class="modal">
            <div class="modal-content">
                <span class="close" id="closeModal">&times;</span>
                <h2>Apply to <?= htmlspecialchars($company_name) ?></h2>

                <form id="applicationForm" action="/detail-lowongan-jobseeker?id=<?= $lowongan_id ?>" method="post" enctype="multipart/form-data">
                    <!-- resume  -->
                    <div class="form-group">
                        <label for="cv">Resume *
                            <span><br>PDF (2 MB)</span>
                        </label>
                        <div class="upload-box">
                            <div class="file-type">PDF</div>
                            <span id="resumeFileName">No file chosen</span>
                        </div>
                        <!-- <div id="error-message" class="error-message">
                            <?php if (isset($data['error'])) echo $data['error'] ?>
                        </div> -->
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

                    <div class="submit-button">
                        <button type="submit" class="button">Submit Application</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- job details -->
        <div class="job-description">
            <h2>About the job</h2>
            <p><?= nl2br(htmlspecialchars($deskripsi)) ?></p>
        </div>

        <!-- application status -->
        <?php if ($data['jobseekerHasApplied']): ?>
            <section id="application-status">
                <h2>Your Application</h2>
                <ul>
                    <li>Status: <?= $data['lamaranStatus'][0]['status'] ?></li>
                    <li>Attachments:
                        <a href="<?= $data['lamaranStatus'][0]['cv_path'] ?>" target="_blank" class="button-attachment">CV</a>
                        <?php if (!empty($data['lamaranStatus'][0]['video_path'])): ?>
                            <a href="<?= $data['lamaranStatus'][0]['video_path'] ?>" target="_blank" class="button-attachment">Video</a>
                        <?php endif; ?>
                    </li>
                    <?php if (!empty($data['lamaranStatus'][0]['status_reason'])): ?>
                        <li>Next Step: <?= $data['lamaranStatus'][0]['status_reason'] ?></li>
                    <?php endif; ?>
                </ul>
            </section>
        <?php endif; ?>
    </section>
    

    <script src="/public/js/detail-lowongan-jobseeker.js"></script>
</body>
</html>
