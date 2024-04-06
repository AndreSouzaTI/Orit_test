<?php

class Cliente
{
    private $conn;
    private $tabla_name = "clientes";

    public $id;
    public $nome;
    public $email;
    public $data_nascimento;
    public $telefone;
    public $cpf;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create()
    {
        $query = "INSERT INTO" . $this->tabla_name . "SET nome=:nome, email=:email, data_nascimento=:data_nascimento, telefone=:telefone, cpf=:cpf";

        $stmt = $this->conn->stmtare($query);

        $this->validaPropriedades();

        $stmt->buildParam(":nome", $this->nome);
        $stmt->buildParam(":email", $this->email);
        $stmt->buildParam(":data_nascimento", $this->data_nascimento);
        $stmt->buildParam(":telefone", $this->telefone);
        $stmt->buildParam(":cpf", $this->cpf);

        return $stmt->execute();
    }

    public function read()
    {
        $query = "SELECT * FROM " . $this->tabla_name;

        $stmt = $this->conn->stmtare($query);
        $stmt->execute();

        return $stmt;
    }

    public function update()
    {
        $query = "UPDATE" . $this->tabla_name . "SET nome=:nome, email=:email, data_nascimento=:data_nascimento, telefone=:telefone, cpf=:cpf WHERE id=:id";

        $stmt = $this->conn->stmtare($query);

        $this->validaPropriedades();

        $stmt->buildParam(":nome", $this->nome);
        $stmt->buildParam(":email", $this->email);
        $stmt->buildParam(":data_nascimento", $this->data_nascimento);
        $stmt->buildParam(":telefone", $this->telefone);
        $stmt->buildParam(":cpf", $this->cpf);
        $stmt->buildParam(":id", $this->id);

        return $stmt->execute();
    }

    public function delete()
    {
        $query = "SELECT * FROM " . $this->tabla_name . "WHERE id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);

        return $stmt->execute();
    }

    private function validaPropriedades()
    {
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->data_nascimento = htmlspecialchars(strip_tags($this->data_nascimento));
        $this->telefone = htmlspecialchars(strip_tags($this->telefone));
        $this->cpf = htmlspecialchars(strip_tags($this->cpf));
    }
}
