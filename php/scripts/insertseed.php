<?php

require_once __DIR__ . "/../lib/database.php";
require_once __DIR__ . "/../models/user.model.php";
require_once __DIR__ . "/../models/lamaran.model.php";
require_once __DIR__ . "/../models/attachment-lowongan.model.php";
require_once __DIR__ . "/../models/cv.model.php";
require_once __DIR__ . "/../models/video.model.php";
require_once __DIR__ . "/../models/attachment.model.php";

function getFileNames($path){
    $namesList = [];
    $dirHandle = opendir($path);
    while (($file = readdir($dirHandle)) !== false) {
        if ($file != '.' && $file != '..') {
            $namesList[] = $file;
        }
    }
    return $namesList;
}

function insert_seed_to_db(){
    // mungkin nanti sesuaikan dengan jumlah user dan lowongan idk
    $db = new Database($_ENV["DB_NAME"], $_ENV["DB_PORT"], $_ENV["POSTGRES_DB"], $_ENV["POSTGRES_USER"], $_ENV["POSTGRES_PASSWORD"]);
    $cvFolder = "uploads/cv";
    $videosFolder = "uploads/videos";
    $attachmentsFolder = "uploads/attachments";
    $cvPaths = getFileNames($cvFolder);
    $videosPaths = getFileNames($videosFolder);
    $attachmentsPaths = getFileNames($attachmentsFolder);

    for ($i = 0; $i < 6; $i++){
        Lamaran::insertLamaran((($i % 2) + 1), (($i % 3) + 1), new CV(($cvFolder . '/' . $cvPaths[$i]), null), new Video(($videosFolder . '/' . $videosPaths[$i]), null));
        AttachmentLowongan::insertAttachmentLowongan((($i % 3) + 1), new Attachment(($attachmentsFolder . '/' . $attachmentsPaths[$i]), null));
    }
}