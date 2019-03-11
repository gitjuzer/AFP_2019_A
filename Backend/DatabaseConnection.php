<?php

class DatabaseConnection {

    $server;
    $username;
    $password;
    $db;

    $connection;

    public function getConnection() {
        $con = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname) or die("Connection failed: " . mysqli_connect_error());

        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        } else {
            $this->connection = $con;
        }
        
        return $this->connection;
    }

    public function __construct() {
        $this->server = SERVERNAME;
        $this->username = USERNAME;
        $this->password = PASSWORD;
        $this->db = DBNAME;
    }
}

