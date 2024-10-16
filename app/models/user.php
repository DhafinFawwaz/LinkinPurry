<?php
require_once __DIR__ . "/model.php";
require_once __DIR__ . "/image.php";

class User extends Model {
    public string $email;
    public string $password;
    public string $username;
    public string $role;
    public Image $profilePicture;

    public function __construct(string $email, string $password, string $role, string $username) {
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->username = $username;
    }

    public static function getUserByEmail(string $email) {
        Model::DB()->query("SELECT * FROM \"User\" WHERE email = $1", array($email));
        $res = Model::DB()->fetchRow();
        return new User($res[1], $res[2], $res[3], $res[4]);
    }

    /**
     * Will throw an exception if the email is already in use
     * @param string $username can have duplicates
     * @param string $email unique
     * @param string $password atleast 8 characters, must contain a number and a letter
     * @return void
     */
    public static function insertJobseeker(string $email, string $password, string $role, string $username) {
        Model::DB()->query("INSERT INTO \"User\" (email, password, role, nama) VALUES ($1, $2, $3, $4)", [$email, $password, $role, $username]);
    }

    public static function insertCompany(string $email, string $password, string $username, string $location, string $about) {
        Model::DB()->query("CALL create_user_company($1, $2, $3, $4, $5);", [$email, $password, $username, $location, $about]);
    }

    public function toJsonString(): string {
        return json_encode($this);
    }
}

