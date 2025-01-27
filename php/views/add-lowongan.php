<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Vacancy - <?= htmlspecialchars($data["user"]["username"]) ?></title>
    <meta name="description" content="Add new job">

    <link rel="stylesheet" href="/public/css/detail-lowongan.css">
    <link rel="stylesheet" href="/public/css/edit-lowongan.css">
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
</head>
<body>
    <?php include 'component/toaster.php'; ?>
    <?php include 'component/navbar.php'; ?>

    
    <section id="job-details-wrapper">
        <form method="post" action="/add" enctype="multipart/form-data">
            <div class="company-container">
                <div class="company-profile">
                    <img src="../public/assets/company_profile.svg" alt="company-profile">
                    <h2><?= htmlspecialchars($data["user"]["username"]) ?></h2>
                </div>
                
                <div class="form__input">
                    <input id="posisi" name="posisi" required="" autofocus=""  type="text">
                    <label for="posisi">Posisi:</label>
                </div>

                <div class="filter-sort-container">
                    <select name="jenis_pekerjaan" id="job-type-filter">
                        <option value="Full Time">Full Time</option>
                        <option value="Part Time">Part Time</option>
                        <option value="Internship">Internship</option>
                    </select>
                </div>
                <div class="filter-sort-container">
                    <select name="jenis_lokasi" id="location-type-filter">
                        <option value="On-Site">On-Site</option>
                        <option value="Hybrid">Hybrid</option>
                        <option value="Remote">Remote</option>
                    </select>
                </div>
            </div>

            <!-- job details -->
            <div class="job-description-container">
                <h2>About the job</h2>
                
                <div class="job-details">
                    <div class="quill-container">
                        <div id="quillEditor"></div>
                    </div>
                    <textarea name="deskripsi" style="display:none" id="hiddenArea"></textarea>
                </div>
            </div>

            <br>
            
            <input id="attachment-input" hidden type="file" id="attachment" name="attachments[]" accept="image/png, image/jpeg, image/jpg" multiple>
            <label for="attachment-input" class="upload-box">
                <div class="file-type">
                    <div>PNG/JPG</div>    
                </div>
                <div id="attachment-container" class="attachment-container">Please select images(png/jpeg/jpg)</div>
            </label>
            <label for="attachment-input" class="replace-btn">Upload Attachments</label>


            <div class="apply-button-action full-width-child-end">
                <a href="/" class="outline-button">Cancel</a>
                <button id="applyBtn" class="button" type="submit">Add Vacancy</button>
            </div>

        </form>
        
    </section>

    <script src="/public/js/attachment.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
    <script src="/public/js/quill-input.js"></script>

</body>
</html>