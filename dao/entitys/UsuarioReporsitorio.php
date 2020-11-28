<?php
include_once "dao/entitys/Usuario.php";
include_once "dao/IReporsitory.php";
include_once "dao/Conexao.php";

class UsuarioReporsitorio implements IReporsitory
{
    private $conexao;

    /**
     * UsuarioReporsitorio constructor.
     */
    public function __construct()
    {
        $this->conexao = new Conexao();
        $this->conexao->executarSQL(Usuario::getTableSQL());
    }


    /**
     * @inheritDoc
     */
    public function findAll()
    {
        return $this->conexao->executarSQL("SELECT * FROM usuario;");
    }

    /**
     * Metodo para obter um Usuario baseado no ID
     * @param $id int o seu id
     * @return Usuario o Usuario caso encontre ou null.
     */
    public function findById($id)
    {
        $result = $this->conexao->executarSQL("select * from usuario where id=" . $id);
        return $result->fetchObject("usuario");
    }

    /**
     * @inheritDoc
     */
    public function delete($id)
    {
        return $this->conexao->executarSQL("delete from usuario where id=".$id);
    }

    /**
     * @inheritDoc
     */
    public function saveOrUpdate($entity)
    {
        if ($entity instanceof Usuario) {
            $resultado =  $this->conexao->executarSQL("INSERT INTO usuario VALUES  (" . $entity->getId() . ",".
                "'". $entity->getNome()."',".
                "'". $entity->getEmail(). "',".
                "'". $entity->getSenha(). "',".
                "'".$entity->getData()."'".
                ") ON DUPLICATE KEY UPDATE ".
                "nome='". $entity->getNome()."',".
                "email='". $entity->getEmail(). "',".
                "senha='". $entity->getSenha(). "',".
                "data='".$entity->getData()."'".
                ";");
            return $resultado;
        } else {
            return false;
        }
    }

    /**
     * @inheritDoc
     */
    public function exists($id)
    {
        $resultado = $this->conexao->executarSQL("select * from usuario where id=".$id);
        return $resultado->rowCount()>0;
    }
}