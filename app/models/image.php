<?php
require_once __DIR__ . "/model.php";

class Image implements JsonSerializable {
    private static string $uploadDir = __DIR__ . "/../uploads/images/";
    public static function setUploadDir(string $dir){
        Image::$uploadDir = $dir;
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
        move_uploaded_file($this->imageFile, Image::$uploadDir . $this->imageName);
    }

    /**
     * Delete the image from __DIR__ . "/../uploads/images/" . $this->imageName
     * @return void
     */
    public function delete(){
        unlink(Image::$uploadDir . $this->imageName);
    }

    
    public function jsonSerialize(): mixed {
        return [
            "imageName" => $this->imageName,
            "imageUrl" => $this->imageUrl
        ];
    }
}

