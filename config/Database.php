<?php

class Database
{
    // $dbh = new PDO('mysql:host=localhost;dbname=test', $user, $pass);
    private $dbname = "authentication";
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    // private $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbname;
    public $dbh = null;


    // function __construct()
    // {
    // }
    public function connect()
    {
        $this->dsn  = "mysql:host=" . $this->host . ";dbname=" . $this->dbname;

        try {
            $this->dbh = new PDO($this->dsn, $this->user,$this->password);
        } catch (PDOException $e) {
            echo "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        return $this->dbh;
    }
}
