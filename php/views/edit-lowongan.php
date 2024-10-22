<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Lowongan - <?= htmlspecialchars($data["lowongan"]["posisi"]) ?></title>

    <link rel="stylesheet" href="/public/css/detail-lowongan.css">
    <link rel="stylesheet" href="/public/css/edit-lowongan.css">
</head>
<body>
    <?php include 'component/toaster.php'; ?>


    <section id="navbar">
        <?php include 'component/navbar.php'; ?>
    </section>
    
    <section id="job-details-wrapper">
        <form method="post" action="/<?php echo $data["lowongan"]["lowongan_id"] ?>/edit" enctype="multipart/form-data">
            <div class="company-container">
                <div class="company-profile">
                    <img src="../public/assets/company_profile.svg" alt="company-profile">
                    <h2><?= htmlspecialchars($data["user"]["username"]) ?></h2>
                </div>
                
                <div class="form__input">
                    <input id="posisi" name="posisi" required="" autofocus=""  type="text" value="<?= !isset($data["lowongan"]["posisi"]) ? "" : htmlspecialchars($data["lowongan"]["posisi"]) ?>">
                    <label for="posisi">Posisi:</label>
                </div>

                <div class="filter-sort-container">
                    <select name="jenis_pekerjaan" id="job-type-filter">
                        <option <?php if($data["lowongan"]["jenis_pekerjaan"] == "Full Time") echo "selected" ?> value="Full Time">Full Time</option>
                        <option <?php if($data["lowongan"]["jenis_pekerjaan"] == "Part Time") echo "selected" ?> value="Part Time">Part Time</option>
                        <option <?php if($data["lowongan"]["jenis_pekerjaan"] == "Internship") echo "selected" ?> value="Internship">Internship</option>
                    </select>
                </div>
                <div class="filter-sort-container">
                    <select name="jenis_lokasi" id="location-type-filter">
                        <option <?php if($data["lowongan"]["jenis_lokasi"] == "On-Site") echo "selected" ?> value="On-Site">On-Site</option>
                        <option <?php if($data["lowongan"]["jenis_lokasi"] == "Hybrid") echo "selected" ?> value="Hybrid">Hybrid</option>
                        <option <?php if($data["lowongan"]["jenis_lokasi"] == "Remote") echo "selected" ?> value="Remote">Remote</option>
                    </select>
                </div>
            </div>

            <!-- job details -->
            <div class="job-description-container">
                <h2>About the job</h2>
                
                <div class="job-details">
                    <textarea name="deskripsi" id="deskripsi"><?= !isset($data["lowongan"]["deskripsi"]) ? "" : htmlspecialchars($data["lowongan"]["deskripsi"]) ?></textarea>
                </div>
            </div>


            <br>
            
            <input id="attachment-input" hidden type="file" id="attachment" name="attachments[]" accept="image/png, image/jpeg, image/jpg" multiple>
            <label for="attachment-input" class="upload-box">
                <div class="file-type">PNG/JPG</div>    
                <div id="attachment-container" class="attachment-container">
                    <?php
                        foreach($data["attachmentLowongan"] as $attachment) {
                            echo "<div>";
                            $attachmentFilePath = $attachment['file_path'];
                            echo "<img src=$attachmentFilePath>";
                            echo "</div>";
                        }
                    ?>
                </div>
            </label>
            <label for="attachment-input" class="replace-btn">Upload Attachments</label>


            
            <div class="apply-button-action full-width-child-end">
                <a href="/<?php echo $data["lowongan"]["lowongan_id"] ?>" class="outline-button">Cancel</a>
                <button id="applyBtn" class="button" type="submit">Save Changes</button>
            </div>

        </form>
        
    </section>
    
    <script src="/public/js/attachment.js"></script>

</body>
</html>