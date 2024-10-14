<?php

class Database {

    private $dbconn;
    private $preparedStatements = array();
    private $queryResult;

    public function __construct(string $db, string $port, string $dbname, string $user, string $password){
        $this->dbconn = pg_connect("host=".$db." port=".$port." dbname=".$dbname." user=".$user." password=".$password);
        
    }

    public function query(string $query, array $params){
        if(!array_key_exists($query, $this->preparedStatements)){
            pg_prepare($this->dbconn, $query, $query);
            $this->preparedStatements[$query] = true;
        }
        $this->queryResult = pg_execute(
            $this->dbconn,
            $query,
            $params
        );
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

    public function migrate(){
        try{
            $files = glob(__DIR__."/../database/migration/*.sql");
            foreach($files as $file) {
                $content = file_get_contents($file);
                echo $content."\n";
                $this->queryNoParam($content);
            }
        } catch(Exception $e) {
            echo $e;
        }
    }

}