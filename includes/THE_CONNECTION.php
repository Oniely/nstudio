<?php

class Database
{
    private $host;
    private $user;
    private $pass;
    private $db;
    private $conn;

    public function __construct($host = 'localhost', $user = 'root', $pass = '', $db = 'ecommerce_db')
    {
        $this->host = $host;
        $this->user = $user;
        $this->pass =  $pass;
        $this->db = $db;
    }

    public function connectDB()
    {
        // if you want to create a new connection each time connectDB() is called -
        // $this->conn = null;
        if ($this->conn === null) {
            try {
                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db, $this->user, $this->pass);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->conn->exec("set names utf8");
            } catch (PDOException $exception) {
                throw new Exception('Connection error: ' . $exception->getMessage());
            }
        }

        return $this->conn;
    }

    public function closeConnection() {
        $this->conn = null;
    }
}
