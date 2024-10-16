<?php
require_once __DIR__ . "/user.php";

class Company extends User {
    public string $location;
    public string $about;

    public function save() {
        Model::DB()->query("CALL update_user_company($1, $2, $3, $4);", array($this->id, $this->username, $this->location, $this->about));
    }

    public function __construct(int $userId, string $email, string $password, string $role, string $username, string $location, string $about) {
        parent::__construct($userId, $email, $password, $role, $username);
        $this->location = $location;
        $this->about = $about;
    }

    public static function fromUser(User $user) {
        Model::DB()->query("SELECT * FROM \"Company_Detail\" WHERE user_id = $1 LIMIT 1", array($user->id));
        $res = Model::DB()->fetchRow();
        if(!$res) return null;
        return new Company($user->id, $user->email, $user->password, $user->role, $user->username, $res[1], $res[2]);
    }
}