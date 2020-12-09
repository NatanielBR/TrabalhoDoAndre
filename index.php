<?php
include_once "controller/IndexController.php";

$act = "";

$controller = new IndexController();
if (!isset($_GET['act'])){
    $act = "normal";
}else{
    $act = $_GET['act'];
}

$controller->{$act}();