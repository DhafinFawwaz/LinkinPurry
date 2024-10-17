<?php

require_once __DIR__ . "/../lib/database.php";

$db = new Database($_ENV["DB_NAME"], $_ENV["DB_PORT"], $_ENV["POSTGRES_DB"], $_ENV["POSTGRES_USER"], $_ENV["POSTGRES_PASSWORD"]);

$db->queryNoParam("INSERT INTO \"Lowongan\" (lowongan_id, company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi, is_open, created_at, updated_at) VALUES (1, 2, 'Software Engineer', 'We are looking for a software engineer to join our team', 'Full Time', 'Remote', true, '2021-01-01 00:00:00', '2021-01-01 00:00:00'), (2, 2, 'Data Scientist', 'We are looking for a data scientist to join our team', 'Full Time', 'Remote', true, '2021-01-01 00:00:00', '2021-01-01 00:00:00')");

$db->queryNoParam("INSERT INTO \"Lamaran\" (lamaran_id, user_id, lowongan_id, cv_path, video_path, status, status_reason, created_at) VALUES (1, 1, 1, '/uploads/cv/16332293.pdf', '/uploads/videos/0f09abf1ef664ba0bd22cba4cff601fc.mp4', 'waiting', 'We will review your application', '2021-01-01 00:00:00'), (2, 2, 1, '/uploads/cv/17510973.pdf', '/uploads/videos/0e0e018515fb4b96bb6c5e876530744e.mp4', 'waiting', 'We will review your application', '2021-01-01 00:00:00')");


