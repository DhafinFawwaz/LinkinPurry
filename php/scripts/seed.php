<?php

function download_zip_with_progress($url, $save_to) {
    $zip_file = fopen($save_to, 'w+');
    
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FILE, $zip_file);
    curl_setopt($ch, CURLOPT_TIMEOUT, 0);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_NOPROGRESS, false);
    curl_setopt($ch, CURLOPT_PROGRESSFUNCTION, 'progress_callback');

    curl_exec($ch);

    if (curl_errno($ch)) {
        echo "Error: " . curl_error($ch);
    } else {
        echo "File downloaded successfully.\n";
    }
    
    curl_close($ch);
    fclose($zip_file);
}

function progress_callback($resource, $download_size, $downloaded, $upload_size, $uploaded) {
    if ($download_size > 0) {
        $progress = round(($downloaded / $download_size) * 100);
        echo "Download Progress: $progress% (" . round($downloaded / 1024, 2) . " KB of " . round($download_size / 1024, 2) . " KB)\r";
    }
}

function extract_zip($zip_path, $extract_to) {
    $zip = new ZipArchive;
    
    if ($zip->open($zip_path) === TRUE) {
        $zip->extractTo($extract_to);
        $zip->close();
        echo "\nZIP extracted successfully.\n";
    } else {
        echo "\nFailed to open the ZIP file.\n";
    }
}

$zip_url = 'https://drive.usercontent.google.com/download?id=1SzzbAw3WMLmz_UttSZlkM4SVJFs9NkDR&export=download&authuser=0&confirm=t&uuid=c3e11fe5-c45d-4fce-a63d-7078661c8866&at=AN_67v32dUdx85iEJCFB2OGNR6l_%3A1729154278602';
$save_to = 'downloads/dataset.zip';
$extract_to = 'uploads';

if (!is_dir('uploads')) {
    mkdir('downloads', 0777, true);
}

download_zip_with_progress($zip_url, $save_to);
extract_zip($save_to, $extract_to);




