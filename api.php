<?php
include "api/CidadeAPI.php";
include "api/EstadoAPI.php";
include "api/PaisAPI.php";
include "api/FormAPI.php";

/**
 * O funcionamento do arquivo é simples.
 * Basta executar o arquivo e informar por padrão o "type" como get.
 * A requisição ficara assim:
 * /api.php?type=cidade
 *
 * Apos escolher, deve escolher a ação informanto "action" como get.
 * Ficará assim:
 * /api.php?type=cidade&action=listar
 *
 * Caso o action precise de parametros extras, como remover, continue
 * informando adiante.
 */


if (count($_POST) == 0){
    $_POST = json_decode(file_get_contents("php://input"), true);
}
$apis = [new CidadeAPI(), new EstadoAPI(), new PaisAPI(), new FormAPI()];
$api_map = [];
foreach ($apis as $api) {
    $api_map[$api->getAPIName()] = $api;
}
$err_param = [];
if (!isset($_GET['type'])) {
    $err_param[] = "type";
}
if (!isset($_GET['action'])) {
    $err_param[] = "action";
}
if (count($err_param) > 0) {
    die(json_encode(["status" => 400, "mensagem" => "E nescessario informar os parametros obrigatorios!",
        "parametros" => $err_param]));
}

if (array_key_exists($_GET["type"], $api_map)) {
    $api = $api_map[$_GET["type"]];
    foreach (get_class_methods(get_class($api)) as $method) {
        if ($_GET['action'] === $method) {
            $api->{$method}();
        }
    }
} else {
    die(json_encode(["status" => 400, "mensagem" => "Tipo nao encontrado."]));
}