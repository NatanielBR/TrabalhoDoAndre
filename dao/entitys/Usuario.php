<?php
include_once "dao/IEntity.php";

class Usuario implements IEntity
{
    public $id;
    public $nome;
    public $email;
    public $senha;
    public $data;


    public static function getTableSQL()
    {
        return "
CREATE TABLE IF NOT EXISTS `usuario` (
	`id` INT(10) NOT NULL,
	`nome` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`email` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`senha` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`data` DATETIME NULL DEFAULT NULL,
	PRIMARY KEY (`id`) USING BTREE
)
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB;
";
    }
}