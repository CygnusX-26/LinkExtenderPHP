<?php
if (!isset($BASE_URL)) {
    die("Missing required params: BASE_URL");
}
class DB_Connection {
    private $servername;
    private $username;
    private $password;
    private $dbname;
    private $conn;
    function __construct() {
        $this->servername = "localhost";
        $this->username = "root";
        $this->password = "password";
        $this->dbname = "LinkExtender";
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    function insert($url, $path) {
        if ($this->conn->execute_query("INSERT INTO Links (url, path) VALUES (?, ?)", [$url, $path]) === TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function exists($url) {
        if ($this->conn->execute_query("SELECT 1 FROM Links WHERE url = ?", [$url])->fetch_array() !== NULL) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function exists_path($path) {
        if ($this->conn->execute_query("SELECT 1 FROM Links WHERE path = ?", [$path])->fetch_array() !== NULL) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function query_path($url) {
        $res = $this->conn->execute_query("SELECT path FROM Links WHERE url = ?", [$url])->fetch_array();
        if ($res !== NULL) {
            return $res[0];
        } else {
            return FALSE;
        }
    }

    function query_url($path) {
        $res = $this->conn->execute_query("SELECT url FROM Links WHERE path = ?", [$path])->fetch_array();
        if ($res !== NULL) {
            return $res[0];
        } else {
            return FALSE;
        }
    }

    function __destruct() {
        $this->conn->close();
    }
    
}
