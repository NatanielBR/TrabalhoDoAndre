<?php
include_once "dao/IEntity.php";


class Estado implements IEntity
{
    public $id;
    public $nome;
    public $pais_id;


    public static function getTableSQL()
    {
        return "CREATE TABLE IF NOT EXISTS `estados` ( 
            `id` INT NOT NULL AUTO_INCREMENT,
            `nome` varchar(255) NOT NULL,
            `pais_id` INT NOT NULL,
            PRIMARY KEY (`id`),
            CONSTRAINT `FK__paises` FOREIGN KEY (`pais_id`) REFERENCES `paises` (`id`)
        ) COLLATE='utf8mb4_general_ci';";
    }
}