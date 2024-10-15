<?php
require_once __DIR__ . "/model.php";
require_once __DIR__ . "/image.php";

class User extends Model {
    public string $username;
    public string $email;
    public string $password;
    public Image $profilePicture;

    public static function getAllUserLikeUsername(string $username) {
        // $this->db->query("SELECT * FROM users WHERE name LIKE $1", array("%".$username."%"));
        Model::DB()->queryNoParam("SELECT * FROM users");
        return Model::DB()->fetchAll();
    }

    public function toJsonString(): string {
        return json_encode($this);
    }
}

