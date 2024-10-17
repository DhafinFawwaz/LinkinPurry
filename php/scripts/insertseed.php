<?php

require_once __DIR__ . "/../lib/database.php";
require_once __DIR__ . "/../models/user.model.php";

function insert_seed_to_db(){
    // $db = new Database($_ENV["DB_NAME"], $_ENV["DB_PORT"], $_ENV["POSTGRES_DB"], $_ENV["POSTGRES_USER"], $_ENV["POSTGRES_PASSWORD"]);
    // User::insertJobseeker('jobseeker1@example.com', '$2y$10$G2aIX05s4Gsa50DAcEIHuu0jpTrpOhaZKQOVcnfp7tfgk3Mt8Oom6', 'John Doe');

    // User::insertCompany('jobseeker1@example.com', '$2y$10$G2aIX05s4Gsa50DAcEIHuu0jpTrpOhaZKQOVcnfp7tfgk3Mt8Oom6', 'John Doe', 'Jakarta', 'We are a company');

    // Lowongan::insertLowongan(1, 'Software Engineer', 'We are looking for a software engineer', 'full time', 'on-site');

    // Lamaran::insertLamaran(1, 1, new CV(1, null), new Video(1, null));

    // AttachmentLowongan::insertAttachmentLowongan(1, new Attachment(1, 'file_path'));
    

}