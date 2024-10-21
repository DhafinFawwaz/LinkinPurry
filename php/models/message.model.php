<?php

class Message implements JsonSerializable {

    public string $title;
    public string $content;
    public string $level; // success, error, info, warning

    public function __construct(string $title, string $content, string $level){
        $this->title = $title;
        $this->content = $content;
        $this->level = $level;
    }

    public static function Info(string $title, string $content){
        $_SESSION["message"] = new Message($title, $content, "info");
    }

    public static function Error(string $title, string $content){
        $_SESSION["message"] = new Message($title, $content, "error");
    }

    public static function Success(string $title, string $content){
        $_SESSION["message"] = new Message($title, $content, "success");
    }
    
    public static function Warning(string $title, string $content){
        $_SESSION["message"] = new Message($title, $content, "warning");
    }
    
    public function jsonSerialize(): mixed {
        return json_encode($this); 
    }
}

