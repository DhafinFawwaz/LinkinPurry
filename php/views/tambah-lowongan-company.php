<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Lowongan</title>

    <!-- css link or something idk -->
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
</head>
<body>
    <!-- nav -->
    <nav>
        <ul>
            <li><a href="/home-company">Home</a></li>
            <li><a href="/profile">Profile</a></li>
        </ul>
    </nav>

    <!-- isi lowongan -->
    <form action="/add" method="POST">

        <label for="position">Posisi:</label>
        <input type="text" id="position" name="position"><br><br>

        <label for="desc">Deskripsi:</label><br>
        <div id="desc" name="desc"></div><br><br>

        <label>Jenis:</label><br>
        <input type="radio" id="fullTime" name="type" value="fullTime">
        <label for="fullTime">Full Time</label><br>
        <input type="radio" id="partTime" name="type" value="partTime">
        <label for="partTime">Part Time</label><br>
        <input type="radio" id="internship" name="type" value="internship">
        <label for="internship">Internship</label><br><br>
        
        <label>Lokasi:</label><br>
        <input type="radio" id="onSite" name="type" value="onSite">
        <label for="onSite">On-Site</label><br>
        <input type="radio" id="hybrid" name="type" value="hybrid">
        <label for="hybrid">Hybrid</label><br>
        <input type="radio" id="remote" name="type" value="remote">
        <label for="remote">Remote</label><br><br>

        <button type="submit">Tambah</button>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
    <script>
    const quill = new Quill('#desc', {
        theme: 'snow'
    });
    </script>
</body>
</html>