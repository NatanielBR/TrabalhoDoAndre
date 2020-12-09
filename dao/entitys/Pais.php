<?php
include_once "dao/IEntity.php";

class Pais implements IEntity
{
    public $pais_id;
    public $nome;


    public static function getTableSQL()
    {
        return "CREATE TABLE IF NOT EXISTS `paises` ( `pais_id` INT NOT NULL AUTO_INCREMENT, `nome` VARCHAR(255) NOT NULL, PRIMARY KEY (`pais_id`))COLLATE='utf8mb4_general_ci';";
    }
}