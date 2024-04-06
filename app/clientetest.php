<?php

use PHPUnit\Framework\TestCase;



class ClienteTest extends TestCase
{
    private $conn;
    private $cliente;

    protected function setUp(): void
    {
        $this->conn = new PDO("mysql:host=localhost;dbname=crud_clientes_test", "root", "");
        $this->cliente = new Cliente($this->conn);
    }

    public function testCreate()
    {
        $this->cliente->nome = "Teste";
        $this->cliente->email = "teste@teste.com";
        $this->cliente->data_nascimento = "1990-01-01";
        $this->cliente->cpf = "123.456.789-00";

        $result = $this->cliente->create();

        $this->assertTrue($result);
    }

    public function testRead()
    {
        $stmt = $this->cliente->read();
        $num = $stmt->rowCount();

        $this->assertGreaterThan(0, $num);
    }

    public function testUpdate()
    {
        $this->cliente->id = 1;
        $this->cliente->nome = "Teste Atualizado";
        $this->cliente->email = "teste_atualizado@teste.com";
        $this->cliente->data_nascimento = "1990-01-01";
        $this->cliente->cpf = "123.456.789-00";

        $result = $this->cliente->update();

        $this->assertTrue($result);
    }

    public function testDelete()
    {
        $this->cliente->id = 1;

        $result = $this->cliente->delete();

        $this->assertTrue($result);
    }
}
