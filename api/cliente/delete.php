<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$database = new Database();
$db = $database->getConnection();

$cliente = new Cliente($db);

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->id)) {
    $cliente->id = $data->id;

    if ($cliente->delete()) {
        http_response_code(200);
        echo json_encode(array("message" => "Cadastro excluído com sucesso."));
    } else {
        http_response_code(503);
        echo json_encode(array("message" => "Não foi possível excluir o cadastro"));
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "ID não fornecido. Não foi possível excluir o cadastro"));
}
