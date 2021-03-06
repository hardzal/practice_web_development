<?php

class Database
{
    private $dbUsername = "root";
    private $dbPassword = "";
    private $dbName = "sc_nwind";
    private $dbHost = "localhost";

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
