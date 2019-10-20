<?php
include "config.php";
class Database
{
    private $dbUsername = DB_USERNAME;
    private $dbPassword = DB_PASSWORD;
    private $dbName = DB_NAME;
    private $dbHost = DB_HOST;

    public function connect()
    {
        try {
            $db = new mysqli($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbName);
        } catch (Exception $er) {
            die($er->getMessage());
            return false;
        }

        return $db;
    }

    public function disconnect()
    {
        $this->db = null;
    }
}
