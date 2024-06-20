<?php

class Database
{
    private $host;
    private $username;
    private $password;
    private $database;
    private $port;
    private $dbh;

    public function __construct()
    {
        $this->host = 'localhost';
        $this->username = 'root';
        $this->password = '';
        $this->database = 'php_FavoriteMotors';
        $this->port = 3306;
        
        $dsn = "mysql:host=$this->host;port=$this->port;dbname=$this->database";
        try{
            $this->dbh = new PDO($dsn, $this->username, $this->password);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection error: " . $e->getMessage());
        }
    }

    public function run($query, $args = null) : PDOStatement | false
    {
        $stmt = $this->dbh->prepare($query);
        $stmt->execute($args);
        return $stmt;
    }

    public function lastId()
    {
        return $this->dbh->lastInsertId();
    }
}

