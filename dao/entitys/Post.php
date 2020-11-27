<?php
include_once "dao/IEntity.php";

class Post implements IEntity
{
    private $id = -1;
    private $texto;

    /**
     * @return string
     */
    public function getTexto()
    {
        return $this->texto;
    }

    /**
     * @param string $texto
     */
    public function setTexto($texto)
    {
        $this->texto = $texto;
    }


    public static function getTableSQL()
    {
        return "CREATE TABLE IF NOT EXISTS `posts` (`id` INT NOT NULL AUTO_INCREMENT,`texto` TEXT NULL,PRIMARY KEY (`id`)) COLLATE='utf8mb4_general_ci';";
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
}