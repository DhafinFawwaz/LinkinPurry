<?php
// Data dummy
// Data Perusahaan (company_detail)
$companies = [
    [
        'user_id' => 1,
        'nama' => 'NTT DATA, Inc.',
        'lokasi' => 'Jakarta, Jakarta, Indonesia',
        'about' => 'We are renowned for our technical excellence and leading innovations...'
    ],
    [
        'user_id' => 2,
        'nama' => 'Tokopedia',
        'lokasi' => 'Jakarta, Indonesia',
        'about' => 'Leading online marketplace in Indonesia, focused on innovation and digital solutions...'
    ],
    [
        'user_id' => 3,
        'nama' => 'GoTo Financial',
        'lokasi' => 'Jakarta, Indonesia',
        'about' => 'Providing financial solutions across Southeast Asia...'
    ]
];

// Data Lowongan (lowongan)
$jobs = [
    [
        'lowongan_id' => 1,
        'company_id' => 1,
        'posisi' => 'MS Engineer (L2)',
        'deskripsi' => 'Make an impact with NTT DATA by providing excellent technical support to clients...',
        'jenis_pekerjaan' => 'Full-time',
        'jenis_lokasi' => 'On-site',
        'is_open' => true
    ],
    [
        'lowongan_id' => 2,
        'company_id' => 2,
        'posisi' => 'Backend Engineer',
        'deskripsi' => 'As a backend engineer, you will be responsible for designing, building, and maintaining scalable services...',
        'jenis_pekerjaan' => 'Full-time',
        'jenis_lokasi' => 'Remote',
        'is_open' => true
    ],
    [
        'lowongan_id' => 3,
        'company_id' => 3,
        'posisi' => 'Software Development Engineer',
        'deskripsi' => 'Join the tech team at GoTo Financial to build innovative solutions for millions of users...',
        'jenis_pekerjaan' => 'Contract',
        'jenis_lokasi' => 'Remote',
        'is_open' => false
    ]
];

// Data Lamaran (lamaran)
$applications = [
    [
        'lamaran_id' => 1,
        'user_id' => 101,
        'lowongan_id' => 1,
        'cv_path' => '/path/to/cv_user_101.pdf',
        'video_path' => null,
        'status' => 'waiting',
        'status_reason' => null,
        'created_at' => '2024-10-01 10:00:00'
    ],
    [
        'lamaran_id' => 2,
        'user_id' => 101,
        'lowongan_id' => 2,
        'cv_path' => '/path/to/cv_user_101.pdf',
        'video_path' => '/path/to/video_user_101.mp4',
        'status' => 'accepted',
        'status_reason' => 'Great match for the position',
        'created_at' => '2024-09-10 15:30:00'
    ],
    [
        'lamaran_id' => 3,
        'user_id' => 101,
        'lowongan_id' => 3,
        'cv_path' => '/path/to/cv_user_101.pdf',
        'video_path' => '/path/to/video_user_101.mp4',
        'status' => 'rejected',
        'status_reason' => 'Not enough relevant experience',
        'created_at' => '2024-08-15 09:45:00'
    ]
];

function getCompanyNameById($company_id, $companies) {
    foreach ($companies as $company) {
        if ($company['user_id'] == $company_id) {
            return $company['nama'];
        }
    }
    return 'Unknown Company';
}

function getCompanyLocationById($company_id, $companies) {
    foreach ($companies as $company) {
        if ($company['user_id'] == $company_id) {
            return $company['lokasi'];
        }
    }
    return 'Unknown Location';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Application History</title>

    <link rel="stylesheet" href="../public/css/riwayat-lamaran.css">
</head>
<body>
    <div class="container">
        <h2>Job Application History</h2>

        <?php foreach ($applications as $application) : ?>
            <?php
                $jobDetails = null;
                foreach ($jobs as $job) {
                    if ($job['lowongan_id'] == $application['lowongan_id']) {
                        $jobDetails = $job;
                        break;
                    }
                }
            ?>
            <div class="job-card">
                <div class="job-profile">
                    <img src="../public/assets/company_profile.svg" alt="company-profile">
                    <div class="job-info">
                        <div class="job-title"><?= $jobDetails['posisi']; ?></div>
                        <div class="company-info"><?= getCompanyNameById($jobDetails['company_id'], $companies); ?></div> 
                        <div class="company-info"><?= getCompanyLocationById($jobDetails['company_id'], $companies); ?></div>
                        <div class="company-info"><br>Applied on <?= date("F j, Y", strtotime($application['created_at'])); ?></div>
                        <!-- <div class="company-info"><?= $jobDetails['deskripsi']; ?></div> -->
                    </div>
                </div>
                <div class="status <?= $application['status']; ?>">
                    <?= ucfirst($application['status']); ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
