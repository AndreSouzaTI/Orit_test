<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$database = new Database();
$db = $database->getConnection();

$cliente = new Cliente($db);

$data = json_decode(file_get_contents("php://input"));

if (
    !empty($data->nome) &&
    !empty($data->email) &&
    !empty($data->data_nascimento) &&
    !empty($data->cpf)
) {
    $cliente->id = $data->id;
    $cliente->nome = $data->nome;
    $cliente->email = $data->email;
    $cliente->data_nascimento = $data->data_nascimento;
    $cliente->telefone = $data->telefone;
    $cliente->cpf = $data->cpf;

    if ($cliente->create()) {
        http_response_code(201);
        echo json_encode(array("message" => "Atualização efetuada com sucesso."));
    } else {
        http_response_code(503);
        echo json_encode(array("message" => "Não foi possível atualizar o cadastro."));
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Dados incompletos. Atualização não efetuado."));
}
