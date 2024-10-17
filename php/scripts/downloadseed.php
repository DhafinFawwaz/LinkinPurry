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





