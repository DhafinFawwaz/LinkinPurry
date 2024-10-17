<?php

require_once __DIR__ . "/downloadseed.php";
require_once __DIR__ . "/extractseed.php";
require_once __DIR__ . "/insertseed.php";

$zip_url = 'https://drive.usercontent.google.com/download?id=1SzzbAw3WMLmz_UttSZlkM4SVJFs9NkDR&export=download&authuser=0&confirm=t&uuid=c3e11fe5-c45d-4fce-a63d-7078661c8866&at=AN_67v32dUdx85iEJCFB2OGNR6l_%3A1729154278602';
$save_to = 'downloads/dataset.zip';
$extract_to = 'uploads';

function mkdirifnotexist(string $dir){
    if(!is_dir($dir)) mkdir($dir, 0777, true);
}

mkdirifnotexist('downloads');
mkdirifnotexist('uploads');
mkdirifnotexist('uploads/cv');
mkdirifnotexist('uploads/videos');
mkdirifnotexist('uploads/attachments');

download_zip_with_progress($zip_url, $save_to);
extract_zip($save_to, $extract_to);
insert_seed_to_db();