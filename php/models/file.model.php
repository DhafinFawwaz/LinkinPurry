<?php

class File implements JsonSerializable {
    public function getUploadDir() {
        return __DIR__ . "/../uploads/files/";
    }

    public string $path;
    public $bin; // This is a binary data of the image. May come from $_FILES["image"]["image_name"]
    
    public function __construct(string $url, $bin) {
        $this->path = $url;
        $this->bin = $bin;
    }

    /**
     * Save to __DIR__ . "/../uploads/images/" . $this->imageName
     * Dont forget to append the imageName with a hash to prevent overwriting
     * @return void
     */
    public function save(){
        $uploadDir = $this->getUploadDir();
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true); 
        }
        move_uploaded_file($this->bin, $uploadDir . $this->path);
    }

    /**
     * Delete the image from __DIR__ . "/../uploads/images/" . $this->imageName
     * @return void
     */
    public function delete(){
        unlink($this->getUploadDir() . $this->path);
    }

    
    public function jsonSerialize(): mixed {
        return [
            "path" => $this->path
        ];
    }
}

