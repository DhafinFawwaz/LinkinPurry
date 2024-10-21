<?php
require_once __DIR__ . "/model.php";

class User extends Model {
    public int $id;
    public string $email;
    public string $password;
    public string $username;
    public string $role;

    public function __construct(int $userId, string $email, string $password, string $role, string $username) {
        $this->id = $userId;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->username = $username;
    }

    public static function fromSqlRow(array $row) {
        return new User($row[0], $row[1], $row[2], $row[3], $row[4]);
    }

    public static function getUserById(int $userId) {
        self::DB()->query("SELECT * FROM \"User\" WHERE user_id = $1", array($userId));
        $res = self::DB()->fetchRow();
        if(!$res) return null;
        return self::fromSqlRow($res);
    }

    public static function getUserByEmail(string $email) {
        self::DB()->query("SELECT * FROM \"User\" WHERE email = $1", array($email));
        $res = self::DB()->fetchRow();
        if(!$res) return null;
        return self::fromSqlRow($res);
    }

    /**
     * Will throw an exception if the email is already in use
     * @param string $username can have duplicates
     * @param string $email unique
     * @param string $password atleast 8 characters, must contain a number and a letter
     * @return void
     */
    public static function insertJobseeker(string $email, string $password, string $username) {
        $role = "jobseeker";
        self::DB()->query("INSERT INTO \"User\" (email, password, role, nama) VALUES ($1, $2, $3, $4)", [$email, $password, $role, $username]);
    }

    public static function insertCompany(string $email, string $password, string $username, string $location, string $about) {
        self::DB()->query("CALL create_user_company($1, $2, $3, $4, $5);", [$email, $password, $username, $location, $about]);
    }

    public static function getFromLamaranId(int $lamaranId) {
        self::DB()->query("SELECT * FROM \"User\" JOIN \"Lamaran\" USING(user_id) WHERE lamaran_id = $1", array($lamaranId));
        $res = self::DB()->fetchRow();
        if(!$res) return null;
        return self::fromSqlRow($res);
    }

    public function save() {
        self::DB()->query("UPDATE \"User\" SET nama=$1 WHERE user_id=$2", array($this->username, $this->id));
    }

    public function jsonSerialize(): string {
        return json_encode($this);
    }
}

