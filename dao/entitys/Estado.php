<?php
include_once "dao/IEntity.php";


class Estado implements IEntity
{
    public $estado_id;
    public $nome;
    public $pais_id;


    public static function getTableSQL()
    {
        return "CREATE TABLE IF NOT EXISTS `estados` ( 
            `estado_id` INT NOT NULL AUTO_INCREMENT,
            `nome` varchar(255) NOT NULL,
            `pais_id` INT NOT NULL,
            PRIMARY KEY (`estado_id`),
            CONSTRAINT `FK__paises` FOREIGN KEY (`pais_id`) REFERENCES `paises` (`pais_id`)
        ) COLLATE='utf8mb4_general_ci';";
    }
}