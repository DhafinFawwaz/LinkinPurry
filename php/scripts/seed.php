<?php

require_once __DIR__ . "/downloadseed.php";
require_once __DIR__ . "/extractseed.php";
require_once __DIR__ . "/insertseed.php";

$zip_url = 'https://drive.google.com/uc?export=download&id=1eJrTmKQfSjBHKymC6pzLx2rKpNGz0peA';
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