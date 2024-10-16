<?php

class Database {

    private $dbconn;
    private $preparedStatements = array();
    private $queryResult;
    public function getCurrentQueryResult() {
        return $this->queryResult;
    }

    private static $DBConnectSleepDuration = 2;
    
    public function __construct(string $db, string $port, string $dbname, string $user, string $password){
        
        while (!$this->dbconn) {
            $this->dbconn = pg_connect("host=".$db." port=".$port." dbname=".$dbname." user=".$user." password=".$password);
            if(!$this->dbconn) {
                echo "Failed to connect to database, retry in 2 seconds...\n";
                sleep(Database::$DBConnectSleepDuration);
            } else {
                // echo "Database connected!\n";
                break;
            }
        }
        
    }

    public function query(string $query, array $params){
        if(!array_key_exists($query, $this->preparedStatements)){
            pg_prepare($this->dbconn, $query, $query);
            $this->preparedStatements[$query] = true;
        }

        $this->queryResult = @pg_execute(
            $this->dbconn,
            $query,
            $params
        );

        if(!$this->queryResult) {
            throw new Exception(pg_last_error($this->dbconn));
        }
    }
    public function queryNoParam(string $query) {
        $this->query($query, array());
    }

    public function fetchRow() {
        return pg_fetch_row($this->queryResult);
    }
    public function fetchAll() {
        return pg_fetch_all($this->queryResult);
    }

    public function isTableExists(string $table) {
        $query = "SELECT EXISTS (
            SELECT 1
            FROM pg_catalog.pg_class c
            JOIN pg_catalog.pg_namespace n ON n.oid = c.relnamespace
            WHERE c.relname = '$table'
            AND c.relkind = 'r'
            AND n.nspname = 'public'
        )";
        $result = pg_query($this->dbconn, $query);
        $row = pg_fetch_all_columns($result);
        return $row[0] == 't';
    }

    public function migrate(){
        echo "Checking database...\n";
        if(!$this->isTableExists("User")) {
            echo "Users relation not found. Migrating Database...\n";
            try{
                $files = glob(__DIR__."/../database/migration/*.sql");
                foreach($files as $file) {
                    $content = file_get_contents($file);
                    echo $content."\n";
                    pg_query($this->dbconn, $content);
                }
                echo "Database migrated successfully\n";
            } catch(Exception $e) {
                echo $e;
            }
        }
        echo "Database is ready!\n";
    }

}