<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Details - <?= htmlspecialchars($data["lowongan"]["posisi"]) ?></title>

    <link rel="stylesheet" href="/public/css/detail-lowongan.css">
    <link rel="stylesheet" href="../public/css/riwayat-lamaran1.css">

</head>
<body>
    <?php include 'component/toaster.php'; ?>

    <section id="navbar">
        <?php include 'component/navbar.php'; ?>
    </section>
    
    <section id="job-details-wrapper">
        <!-- company profile -->
        <div class="company-container">
            <div class="company-profile">
                <img src="/public/assets/company_profile.svg" alt="company-profile">
                <h2><?= htmlspecialchars($data["user"]["username"]) ?></h2>
            </div>
            <div class="job-details">
                <div class="job-title-status">
                    <h2><?= htmlspecialchars($data["lowongan"]["posisi"]) ?></h2>
                    <?= $data["lowongan"]["is_open"] ? "<div class='open-label'>Open</div>" : "<div class='closed-label'>Closed</div>" ?>
                </div>
                <p><?= htmlspecialchars($data["lowongan"]["posisi"]) ?> | <?= htmlspecialchars($data["lowongan"]["created_at"]) ?></p>
                <!-- <p><?= htmlspecialchars($data["company"]["about"]) ?></p> -->
            </div>
            <div class="job-type">
                <p>
                    <img src="/public/assets/bag_icon.svg" class="icon" alt="location-icon">
                    <?= htmlspecialchars($data["company"]["location"]) ?> | <?= htmlspecialchars($data["lowongan"]["jenis_lokasi"]) ?>
                </p>
                <p>
                    <img src="/public/assets/bag_icon.svg" class="icon" alt="job-icon">
                    <?= htmlspecialchars($data["lowongan"]["jenis_pekerjaan"]) ?>
                </p>
            </div>
        </div>

        <!-- apply button -->
        <?php if($data["canEdit"]) { ?>
            <div class="apply-button-action">
                <a href="/<?php echo $data["lowongan"]["lowongan_id"] ?>/edit" class="button edit-button">Edit</a>
                <?php if($data["lowongan"]["is_open"]) { ?>
                    <form method="post" action="/<?php echo $data["lowongan"]["lowongan_id"] ?>/close">
                        <button class="button close-button">Close</button>
                    </form>
                <?php } else { ?>
                    <form method="post" action="/<?php echo $data["lowongan"]["lowongan_id"] ?>/open">
                        <button class="button open-button">Open</button>
                    </form>
                <?php } ?>

                <form method="post" action="/<?php echo $data["lowongan"]["lowongan_id"] ?>/delete">
                    <button class="button delete-button">Hapus</button>
                </form>

            </div>
        <?php } ?>
        
        <!-- modal structure -->
        <div id="applyModal" class="modal">
            <div class="modal-content">
                <span class="close" id="closeModal">&times;</span>
                <h2>Apply to <?= htmlspecialchars($data["user"]["username"]) ?></h2>

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
            <p><?= nl2br(htmlspecialchars($data["lowongan"]["deskripsi"])) ?></p>
        </div>

        <!-- applications -->
        
        <?php if ($data["canEdit"]) : ?>
            <div class="job-description">
                <h2>Applicant</h2>
            </div>

            <?php if(empty($data["lamaranList"])) : ?>
                <p>No job applications found.</p>
            <?php else : ?>
                <?php foreach ($data["lamaranList"] as $application) : ?>
                    <a class="job-card" href="/<?= $application['lowongan_id'] ?>/<?= $application['lamaran_id'] ?>">
                        <div class="job-profile">
                            <img src="/public/assets/company_profile.svg" alt="company-profile">
                            <div class="job-info">
                                <div class="job-title"><?= htmlspecialchars($application["nama"]); ?></div>
                                <div class="company-info"><?= htmlspecialchars($application['email']); ?></div>
                                <div class="company-info"><br>Applied on <?= date("F j, Y", strtotime($application['created_at'])); ?></div>
                            </div>
                        </div>
                        <div class="status <?= htmlspecialchars($application['status']); ?>">
                            <?= ucfirst(htmlspecialchars($application['status'])); ?>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>

        <?php endif; ?>
        
    </section>
    

</body>
</html>
