<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- <link rel="stylesheet" href="/public/global.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
</head>
<body>
    Detail Lamaran <br>

    
    <?php 
        echo "<p>Jobseeker: " . $data["jobseeker"]["username"] . "</p>";
        echo "<p>Email: " . $data["jobseeker"]["email"] . "</p>";
        echo "<embed style='max-height: 20rem;' src='/uploads/pdf/" . $data["lamaran"]["cv_path"] . "' width='800px' height='2100px' />";
        echo "<video width='320' height='240' controls>";
        echo "<source src='/uploads/videos/" . $data["lamaran"]["video_path"] . "' type='video/mp4'>";
        echo "</video>";

        echo "<p>Status: " . $data["lamaran"]["status"] . "</p>";
        echo "<p>Status Reason: " . $data["lamaran"]["status_reason"] . "</p>";

        echo "<form action='" . $data["form"]["action"] . "'method='post'>";
    ?>
    
<!-- if masih $lamaran->status == 'waiting', show form approve/reject -->
<!-- $lamaran->status_reason rich text html -->

        <button type="submit">Approve</button>
        <button type="submit">Reject</button>
    </form>

    <form method="post">
        <div class="container">
            <div id="quillEditor">
            </div>
        </div>
        <textarea name="text" style="display:none" id="hiddenArea"></textarea>
        <button type="submit" class="button">Submit</button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
    <script>
        const options = {
            placeholder: 'Waiting for your precious content',
            theme: 'snow'
        };

        const quill = new Quill('#quillEditor', options);

        const textarea = document.querySelector('#hiddenArea');
        const form = document.querySelector("form");
        form.addEventListener("submit", (e) => {
        // will still trigger basic form submission and textarea value in formdata will be updated, see network inspect after submit
        textarea.value = quill.root.innerHTML;
        })
    </script>
</body>
</html>

