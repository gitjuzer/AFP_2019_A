<?php

class DatabaseConnection {

    var $server = SERVERNAME;
    var $username = USERNAME;
    var $password = PASSWORD;
    var $db = DBNAME;

    var $connection;

    public function getConnection() {
        $con = mysqli_connect($this->server, $this->username, $this->password, $this->db) or die("Connection failed: " . mysqli_connect_error());

        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        } else {
            $this->connection = $con;
        }
        
        return $this->connection;
    }
}

