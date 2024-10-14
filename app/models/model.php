<?php

class Model {
    private static Database $database;
    public static function DB(): Database {
        if(!isset(Model::$database))
           Model::$database = new Database("db", "5432", "job", "postgres", "12345678");
        return Model::$database;
    }
}