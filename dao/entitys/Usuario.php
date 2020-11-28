<?php
include_once "dao/IEntity.php";

class Usuario implements IEntity
{
    private $id;
    private $nome;
    private $email;
    private $senha;
    private $data;

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

    /**
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * @param string $senha
     */
    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

    /**
     * Retorna uma datatime no formato yyyy-mm-dd.
     * @return string
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Setta uma datatime no formato yyyy-mm-dd.
     * @param DateTime $data
     */
    public function setData($data)
    {

        $this->data = $data->format("yy-m-d");
    }


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