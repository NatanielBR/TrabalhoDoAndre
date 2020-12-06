<?php
include_once "dao/IEntity.php";

class Cidade implements IEntity
{
    public $id;
    public $nome;
    public $descricao;
    public $estado_id;

    public static function getTableSQL()
    {
        return "
        CREATE TABLE IF NOT EXISTS `cidades` (
            `id` INT(10) NOT NULL AUTO_INCREMENT,
            `nome` VARCHAR(255) NOT NULL DEFAULT '' COLLATE 'utf8mb4_general_ci',
            `descricao` VARCHAR(255) NOT NULL DEFAULT '' COLLATE 'utf8mb4_general_ci',
            `estado_id` INT(10) NOT NULL,
            PRIMARY KEY (`id`) USING BTREE,
            INDEX `FK__estados` (`estado_id`),
            CONSTRAINT `FK__estados` FOREIGN KEY (`estado_id`) REFERENCES `projeto_andre`.`estados` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION
        )
        COLLATE='utf8mb4_general_ci'
        ENGINE=InnoDB
        AUTO_INCREMENT=12;
        ";
    }
}