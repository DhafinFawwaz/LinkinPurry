<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="/public/css/detail-lamaran.css">
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
</head>
<body>
    <?php include 'component/navbar.php'; ?>

    <section>
        <div>
            
        <?php 
            echo "<h1>" . htmlspecialchars($data["lowongan"]["position"]) . "</h1>";

            echo <<<EOD
            <div class="profile-container">
                <div class="img-container">
                    <img src="/public/assets/jobseeker_profile.svg" alt="profile-picture">
                </div>
                <div class="profile-details-container">
EOD;
            echo "<h2>" . htmlspecialchars($data["jobseeker"]["username"]) . "</h2>";
            echo "<h3>" . htmlspecialchars($data["jobseeker"]["role"]) . "</h3>";
            echo "<h4>" . htmlspecialchars($data["jobseeker"]["email"]) . "</h4>";

            echo "<div class='status-container'>";

            if($data["lamaran"]["status"] == 'waiting') {
                echo "<div class='waiting'>Waiting</div>";
            } else if($data["lamaran"]["status"] == 'accepted') {
                echo "<div class='accepted'>Accepted</div>";
            } else if($data["lamaran"]["status"] == 'rejected') {
                echo "<div class='rejected'>Rejected</div>";
            }
            echo "</div></div></div>";
            

            echo "<div class='file-container'>";
            echo "<h4>CV</h4>";
            echo "<embed src='" . htmlspecialchars($data["lamaran"]["cv_path"]) . "' />";
            echo "<br>";
            if (!empty($data["lamaran"]["video_path"])) {
                echo "<h4>Video</h4>";
                echo "<video height='20rem' controls>";
                echo "<source src='" . htmlspecialchars($data["lamaran"]["video_path"]) . "' type='video/mp4'>";
                echo "</video>";
            }
            echo "</div>";


            if($data["lamaran"]["status"] != 'waiting') {
                echo "<p>Status Reason: </p>";
                echo $data["lamaran"]["status_reason"];
            } else if($data["user"]["role"] == 'company'){ // if not waiting and company
                $formAction = $data["form"]["action"];
                echo <<<EOD
    <form action='$formAction' method='post'>
        <div class="quill-container">
            <div id="quillEditor" style='max-height: 20rem'></div>
        </div>
        <textarea name="status_reason" style="display:none" id="hiddenArea"></textarea>
        
        <div class='submit-button-container'>
            <button class="button1" type="submit" name="status" value="accepted">Accept</button>
            <button class="button1" type="submit" name="status" value="rejected">Reject</button>
        </div>
    </form>
EOD;
            }
        ?>
        </div>
    </section>
    

    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
    <script>
        try {
            const options = {
                placeholder: 'Write a status reason here.',
                theme: 'snow'
            };
    
            const quill = new Quill('#quillEditor', options);
            
            const textarea = document.querySelector('#hiddenArea');
            const form = document.querySelector("form");
            form.addEventListener("submit", (e) => {
                // will still trigger basic form submission and textarea value in formdata will be updated, see network inspect after submit
                textarea.value = quill.root.innerHTML;
            })
        } catch(e) {
}
    </script>
</body>
</html>

