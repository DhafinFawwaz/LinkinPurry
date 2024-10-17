<?php

class File implements JsonSerializable {
    private static string $uploadDir = __DIR__ . "/../uploads/files/";
    public static function setUploadDir(string $dir){
        self::$uploadDir = $dir;
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
        move_uploaded_file($this->bin, File::$uploadDir . $this->path);
    }

    /**
     * Delete the image from __DIR__ . "/../uploads/images/" . $this->imageName
     * @return void
     */
    public function delete(){
        unlink(File::$uploadDir . $this->path);
    }

    
    public function jsonSerialize(): mixed {
        return [
            "path" => $this->path
        ];
    }
}

