<?php

    class DbConfig{

        private $conn;

        function __construct()
        {
            
        }

        function dbConnect(){
            $this->conn = new PDO("mysql:host=localhost;dbname=bakery","root","");
            return $this->conn;
        }
    }
?>