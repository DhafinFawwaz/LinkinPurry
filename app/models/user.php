<?php
require_once __DIR__ . "/model.php";

class User extends Model {
    public static function getAllUserLikeUsername(string $username) {
        // $this->db->query("SELECT * FROM users WHERE name LIKE $1", array("%".$username."%"));
        Model::DB()->query("SELECT * FROM users", array());
        return Model::DB()->fetchAll();
    }
}

