<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- <link rel="stylesheet" href="/public/global.css"> -->
</head>
<body>
    Detail Lamaran <br>

    
    <?php 
        echo "<p>Jobseeker: " . $data["jobseeker"]["username"] . "</p>";
        echo "<p>Email: " . $data["jobseeker"]["email"] . "</p>";
        echo "<embed src='" . $data["lamaran"]["cv_path"] . "' width='800px' height='2100px' />";
        echo "<video width='320' height='240' controls>";
        echo "<source src='" . $data["lamaran"]["video_path"] . "' type='video/mp4'>";
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

</body>
</html>

