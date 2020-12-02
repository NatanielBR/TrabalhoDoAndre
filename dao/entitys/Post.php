<?php
include_once "dao/IEntity.php";

class Post implements IEntity
{
    public $id;
    public $texto;
    public $atualizado;


    public static function getTableSQL()
    {
        return "CREATE TABLE `posts` (`id` INT(10) NOT NULL AUTO_INCREMENT, `texto` TEXT NOT NULL COLLATE 'utf8mb4_general_ci', `atualizado` DATETIME NOT NULL, PRIMARY KEY (`id`) USING BTREE) COLLATE='utf8mb4_general_ci' ENGINE=InnoDB;";
    }

}