<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Application History</title>

    <link rel="stylesheet" href="../public/css/riwayat-lamaran1.css">
</head>
<body>
    <section id="navbar">
        <?php include 'component/navbar.php'; ?>
    </section>

    <div class="container">
        <h2>Job Application History</h2>
        
        <?php if (!empty($data["riwayatLamaran"])) : ?>
            <?php foreach ($data["riwayatLamaran"] as $application) : ?>
                <a class="job-card" href="/<?= $application['lowongan_id'] ?>">
                    <div class="job-profile">
                        <img src="../public/assets/company_profile.svg" alt="company-profile">
                        <div class="job-info">
                            <div class="job-title"><?= htmlspecialchars($application["posisi"]); ?></div>
                            <div class="company-info"><?= htmlspecialchars($application['company_name']); ?></div> 
                            <div class="company-info"><?= htmlspecialchars($application['company_location']); ?></div>
                            <div class="company-info"><br>Applied on <?= date("F j, Y", strtotime($application['created_at'])); ?></div>
                        </div>
                    </div>
                    <div class="status <?= htmlspecialchars($application['status']); ?>">
                        <?= ucfirst(htmlspecialchars($application['status'])); ?>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php else : ?>
            <p>No job applications found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
