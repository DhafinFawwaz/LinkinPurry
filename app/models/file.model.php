<?php

class File implements JsonSerializable {
    private static string $uploadDir = __DIR__ . "/../uploads/files/";
    public static function setUploadDir(string $dir){
        self::$uploadDir = $dir;
    }

    public string $imageName;
    public string $imageUrl;
    public $imageFile; // This is a binary data of the image. May come from $_FILES["image"]["image_name"]
    
    public function __construct(string $imageName, string $imageUrl, $imageFile) {
        $this->imageName = $imageName;
        $this->imageUrl = $imageUrl;
        $this->imageFile = $imageFile;
    }

    /**
     * Save to __DIR__ . "/../uploads/images/" . $this->imageName
     * Dont forget to append the imageName with a hash to prevent overwriting
     * @return void
     */
    public function save(){
        move_uploaded_file($this->imageFile, File::$uploadDir . $this->imageName);
    }

    /**
     * Delete the image from __DIR__ . "/../uploads/images/" . $this->imageName
     * @return void
     */
    public function delete(){
        unlink(File::$uploadDir . $this->imageName);
    }

    
    public function jsonSerialize(): mixed {
        return [
            "fileName" => $this->imageName,
            "fileUrl" => $this->imageUrl
        ];
    }
}

