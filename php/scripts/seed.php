<?php

require_once __DIR__ . "/downloadseed.php";
require_once __DIR__ . "/extractseed.php";
require_once __DIR__ . "/insertseed.php";

$zip_url = 'https://drive.usercontent.google.com/download?id=1HGZuJ7dalt_V6CVfMQ55PfaZY4Wq4RkJ&export=download&authuser=0&confirm=t&uuid=f745c72c-5fd2-400f-a436-5ed697b9e3cf&at=AN_67v1k2-RlpK9w7cx0-o_K8925%3A1729243116681';
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

if(!file_exists('downloads/dataset.zip')){
    download_zip_with_progress($zip_url, $save_to);
}
extract_zip($save_to, $extract_to);
move_files('uploads/data.json', 'downloads/data.json');
insert_seed_to_db();