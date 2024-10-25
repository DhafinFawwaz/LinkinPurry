<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Details - <?= htmlspecialchars($data["lowongan"]["posisi"]) ?></title>
    <meta name="description" content="Job details for <?= htmlspecialchars($data["lowongan"]["posisi"]) ?>">

    <link rel="stylesheet" href="/public/css/detail-lowongan.css">
    <link rel="stylesheet" href="/public/css/riwayat-lamaran.css">

</head>
<body>
    <?php include 'component/toaster.php'; ?>
    <?php include 'component/navbar.php'; ?>
    
    <section id="job-details-wrapper">
        <!-- company profile -->
        <div class="company-container">
            <div class="company-profile">
                <img src="/public/assets/company_profile.svg" alt="company-profile">
                <h2><?= htmlspecialchars($data["company"]["username"]) ?></h2>
            </div>
            <div class="job-details">
                <div class="job-title-status">
                    <h2><?= htmlspecialchars($data["lowongan"]["posisi"]) ?></h2>
                    <?= $data["lowongan"]["is_open"] ? "<div class='open-label'>Open</div>" : "<div class='closed-label'>Closed</div>" ?>
                </div>
                <p><?= htmlspecialchars($data["company"]["location"]) ?></p>
                <p>
                    <?= htmlspecialchars($data["lowongan"]["created_at"]) ?>
                    <?php if($data["lowongan"]["created_at"] != $data["lowongan"]["updated_at"]) echo "(Last Edited {$data['lowongan']['updated_at']})"?>
                </p>
            </div>
            <div class="job-type">
                <p>
                    <img src="/public/assets/bag_icon.svg" class="icon" alt="location-icon">
                    <?= htmlspecialchars($data["lowongan"]["jenis_lokasi"]) ?>
                </p>
                <p>
                    <img src="/public/assets/bag_icon.svg" class="icon" alt="job-icon">
                    <?= htmlspecialchars($data["lowongan"]["jenis_pekerjaan"]) ?>
                </p>
            </div>
        </div>

        <!-- apply button -->
        <div class="apply-button-action">
            <?php if($data["canEdit"]) : ?>
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
            <?php else : ?>
                <?php if ($data['jobseekerHasApplied']): ?>
                    <a href="/<?= $data["lowongan"]["lowongan_id"] ?>/<?= $data['lamaran_id'] ?>" class="button">View Your Application</a>
                <?php elseif (!$data['jobseekerHasApplied']): ?>
                    <button id="applyBtn" class="button">Apply</button>
                <?php endif; ?>
            <?php endif ?>
        </div>
        
        <!-- modal structure (popup) -->
        <div id="applyModal" class="modal hide">
            <div class="modal-content">
                <span class="close" id="closeModal">&times;</span>
                <h2>Apply to <?= htmlspecialchars($data["company"]["username"]) ?></h2>

                <form id="applicationForm" action="/<?= $data["lowongan"]["lowongan_id"] ?>" method="post" enctype="multipart/form-data">
                    <!-- resume  -->
                    <div class="form-group">
                        <label for="cv">Resume *
                            <span><br>PDF</span>
                        </label>
                        <div class="upload-box">
                            <div class="file-type">PDF</div>
                            <span id="resumeFileName">No file chosen</span>
                        </div>
                        <button type="button" class="replace-btn" id="uploadResumeBtn">Upload resume</button>
                        <input type="file" id="cv" name="cv" accept=".pdf">
                        <div id="error-message" class="error-message"></div>
                    </div>

                    <!-- video -->
                    <div class="form-group">
                        <label for="video">Video (Optional)
                            <span><br>MP4</span>
                        </label>
                        <div class="upload-box">
                            <div class="file-type mp4">MP4</div>
                            <span id="videoFileName">No file chosen</span>
                        </div>
                        <button type="button" class="replace-btn" id="uploadVideoBtn">Upload video</button>
                        <input type="file" id="video" name="video" accept="video/mp4">
                    </div>

                    <div class="submit-button">
                        <button type="submit" class="button">Submit Application</button>
                    </div>
                </form>
            </div>
        </div>

        <br>

        <div class="attachment-container no-padding-margin">
            <?php
                if (!empty($data["attachmentLowongan"])) {
                    foreach ($data["attachmentLowongan"] as $attachment) {
                        $src = $attachment["file_path"];
                        echo "<div><img src='$src' alt='attachment image'/></div>";
                    }
                }
            ?>
        </div>

        <!-- job details -->
        <div class="job-description">
            <h2>About the job</h2>
            <p><?= $data["lowongan"]["deskripsi"] ?></p>
        </div>

        <!-- applications -->
        
        <?php if ($data["canEdit"]) : ?>
            <hr>
            <div class="applicant">
                <h2>Applicant</h2>
                <a href="<?= "/api/csv/".$data["lowongan"]["lowongan_id"] ?>" id="download-csv-button" class="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 512 512"><path fill="white" d="M0 64C0 28.7 28.7 0 64 0h160v128c0 17.7 14.3 32 32 32h128v144H176c-35.3 0-64 28.7-64 64v144H64c-35.3 0-64-28.7-64-64zm384 64H256V0zM200 352h16c22.1 0 40 17.9 40 40v8c0 8.8-7.2 16-16 16s-16-7.2-16-16v-8c0-4.4-3.6-8-8-8h-16c-4.4 0-8 3.6-8 8v80c0 4.4 3.6 8 8 8h16c4.4 0 8-3.6 8-8v-8c0-8.8 7.2-16 16-16s16 7.2 16 16v8c0 22.1-17.9 40-40 40h-16c-22.1 0-40-17.9-40-40v-80c0-22.1 17.9-40 40-40m133.1 0H368c8.8 0 16 7.2 16 16s-7.2 16-16 16h-34.9c-7.2 0-13.1 5.9-13.1 13.1c0 5.2 3 9.9 7.8 12l37.4 16.6c16.3 7.2 26.8 23.4 26.8 41.2c0 24.9-20.2 45.1-45.1 45.1H304c-8.8 0-16-7.2-16-16s7.2-16 16-16h42.9c7.2 0 13.1-5.9 13.1-13.1c0-5.2-3-9.9-7.8-12l-37.4-16.6c-16.3-7.2-26.8-23.4-26.8-41.2c0-24.9 20.2-45.1 45.1-45.1m98.9 0c8.8 0 16 7.2 16 16v31.6c0 23 5.5 45.6 16 66c10.5-20.3 16-42.9 16-66V368c0-8.8 7.2-16 16-16s16 7.2 16 16v31.6c0 34.7-10.3 68.7-29.6 97.6l-5.1 7.7c-3 4.5-8 7.1-13.3 7.1s-10.3-2.7-13.3-7.1l-5.1-7.7c-19.3-28.9-29.6-62.9-29.6-97.6V368c0-8.8 7.2-16 16-16"></path></svg>
                    Export To CSV
                </a>
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

    <script src="/public/js/detail-lowongan-jobseeker.js"></script>
    
</body>
</html>
