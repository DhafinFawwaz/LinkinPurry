<?php

require_once __DIR__ . "/../lib/database.php";
require_once __DIR__ . "/../models/user.model.php";

function insert_seed_to_db(){
    $db = new Database($_ENV["DB_NAME"], $_ENV["DB_PORT"], $_ENV["POSTGRES_DB"], $_ENV["POSTGRES_USER"], $_ENV["POSTGRES_PASSWORD"]);

    $db->queryNoParam("TRUNCATE \"Attachment_Lowongan\" CASCADE");
    $db->queryNoParam("TRUNCATE \"Company_Detail\" CASCADE");
    $db->queryNoParam("TRUNCATE \"Lamaran\" CASCADE");
    $db->queryNoParam("TRUNCATE \"Lowongan\" CASCADE");
    $db->queryNoParam("TRUNCATE \"User\" CASCADE");
    
    // read json in uploads/data.json
    $data = json_decode(file_get_contents('downloads/data.json'), true);

    $users = $data['jobseeker'];
    foreach($users as $user){
        $db->query("INSERT INTO \"User\" (user_id, email, password, role, nama) VALUES ($1, $2, $3, $4, $5)", [$user['user_id'], $user['email'], $user['password'], "jobseeker", $user['username']]);
    }

    $companies = $data['companies'];
    foreach($companies as $company){
        $db->query("INSERT INTO \"User\" (user_id, email, password, role, nama) VALUES ($1, $2, $3, $4, $5)", [$company['company_id'], $company['email'], $company['password'], "jobseeker", $company['username']]);
        $db->query("INSERT INTO \"Company_Detail\" (user_id, lokasi, about) VALUES ($1, $2, $3)", [$company['company_id'], $company['location'], $company['about']]);

        $lowongans = $company['lowongan'];
        foreach($lowongans as $lowongan){
            $db->query("INSERT INTO \"Lowongan\" (company_id, posisi, deskripsi, jenis_pekerjaan, jenis_lokasi) VALUES ($1, $2, $3, $4, $5) RETURNING lowongan_id", [$company['company_id'], $lowongan['posisi'], $lowongan['deskripsi'], $lowongan['jenis_pekerjaan'], $lowongan['jenis_lokasi']]);
            $lowongan_id = $db->fetchRow()[0];

            $db->query("INSERT INTO \"Attachment_Lowongan\" (lowongan_id, file_path) VALUES ($1, $2)", [$lowongan_id, $lowongan['attachment_path']]);

            $lamarans = $lowongan['lamaran'];
            foreach($lamarans as $lamaran){
                $db->query("INSERT INTO \"Lamaran\" (lowongan_id, user_id, cv_path, video_path) VALUES ($1, $2, $3, $4)", [$lowongan_id, $lamaran['user_id'], $lamaran['cv_path'], $lamaran['video_path']]);
            }
        }
    }

    // for ($i = 0; $i < 10; $i++) {
    //     User::insertJobseeker('jobseeker1@example.com', '$2y$10$G2aIX05s4Gsa50DAcEIHuu0jpTrpOhaZKQOVcnfp7tfgk3Mt8Oom6', 'John Doe');
    // }

    // for ($i = 0; $i < 10; $i++) {
    //     User::insertCompany('jobseeker1@example.com', '$2y$10$G2aIX05s4Gsa50DAcEIHuu0jpTrpOhaZKQOVcnfp7tfgk3Mt8Oom6', 'John Doe', 'Jakarta', 'We are a company');

    //     for($j = 0; $j < 10; $j++){
    //         Lowongan::insertLowongan(1, 'Software Engineer', 'We are looking for a software engineer', 'full time', 'on-site');
    //         AttachmentLowongan::insertAttachmentLowongan(1, new Attachment(1, 'file_path'));
            
    //         for ($i = 0; $i < 10; $i++) {
    //             Lamaran::insertLamaran(1, 1, new CV(1, null), new Video(1, null));
    //         }
    //     }
    // }
    
    

}