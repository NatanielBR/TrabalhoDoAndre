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
        return $this->conexao->executarSQL("delete from usuario where id=" . $id);
    }

    /**
     * @inheritDoc
     */
    public function saveOrUpdate($entity)
    {
        if ($entity instanceof Usuario) {
            //yy-m-d
            if($entity->data instanceof DateTime){
                $entity->data = $entity->data->format("yy-m-d");
            }

            $resultado = $this->conexao->executarSQL("INSERT INTO usuario VALUES  (" . $entity->id . "," .
                "'" . $entity->nome . "'," .
                "'" . $entity->email . "'," .
                "'" . $entity->senha . "'," .
                "'" . $entity->data . "'" .
                ") ON DUPLICATE KEY UPDATE " .
                "nome='" . $entity->nome . "'," .
                "email='" . $entity->email . "'," .
                "senha='" . $entity->senha . "'," .
                "data='" . $entity->data . "'" .
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
        $resultado = $this->conexao->executarSQL("select * from usuario where id=" . $id);
        return $resultado->rowCount() > 0;
    }
}