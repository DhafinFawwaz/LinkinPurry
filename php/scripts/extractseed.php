<?php
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

$save_to = 'downloads/dataset.zip';
$extract_to = 'uploads';

if (!is_dir('uploads')) {
    mkdir('downloads', 0777, true);
}

extract_zip($save_to, $extract_to);