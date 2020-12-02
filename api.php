<?php
include "api/PostAPI.php";
if (count($_POST) == 0){
    $_POST = json_decode(file_get_contents("php://input"), true);
}
$apis = [new postAPI()];
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