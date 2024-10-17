<?php

abstract class Model implements JsonSerializable {
    private static Database $database;
    public static function DB(): Database {
        if(!isset(Model::$database))
           Model::$database = new Database($_ENV["DB_NAME"], $_ENV["DB_PORT"], $_ENV["POSTGRES_DB"], $_ENV["POSTGRES_USER"], $_ENV["POSTGRES_PASSWORD"]);
        return Model::$database;
    }
}