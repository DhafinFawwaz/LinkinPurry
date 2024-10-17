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

function move_files($source, $destination){
    if(is_dir($source)){
        $files = scandir($source);
        foreach($files as $file){
            if($file != '.' && $file != '..'){
                move_files($source . '/' . $file, $destination . '/' . $file);
            }
        }
        rmdir($source);
    } else {
        rename($source, $destination);
    }
}
