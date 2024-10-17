<?php
require_once __DIR__ . "/model.php";
require_once __DIR__ . "/image.model.php";

class LamaranController extends Model {
    
    public function jsonSerialize(): string {
        return json_encode($this);
    }
}

