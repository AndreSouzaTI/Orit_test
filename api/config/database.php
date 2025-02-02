<?php

class Database
{
    private $host = 'localhost';
    private $db_name = 'cadastro_crud';
    private $username = 'root';
    private $password = '';
    private $conn;



    public function getConnection()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name . $this->username . $this->password);
            $this->conn->exec("set name utf8");
        } catch (PDOException $exception) {
            echo "Erro de conexão: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
