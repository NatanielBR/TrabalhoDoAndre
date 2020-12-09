<?php
include_once "dao/IReporsitory.php";
include_once "dao/Conexao.php";

class CidadeReporsitorio implements IReporsitory
{
    private $conexao;

    /**
     * CidadeReporsitorio constructor.
     */
    public function __construct()
    {
        $this->conexao = new Conexao();
    }

    public function findAll()
    {
        return $this->conexao->executarSQL("select * from cidades");
    }

    public function findById($id)
    {
        return $this->conexao->executarSQL("select * from cidades where id=".$id)->fetchObject("cidade");
    }

    public function delete($id)
    {
        return $this->conexao->executarSQL("delete from cidades where id=".$id);
    }

    public function saveOrUpdate($entity)
    {
        if ($entity instanceof Cidade){
            return $this->conexao->executarSQL("
                INSERT INTO cidades VALUES (".$entity->id.",
                '".$entity->nome."',
                '".$entity->descricao."',
                ".$entity->estado_id.") 
                ON DUPLICATE KEY UPDATE nome= '".$entity->nome."',
                  descricao = '".$entity->descricao."',
                  estado_id=".$entity->estado_id.";");
        }else{
            return false;
        }
    }

    public function exists($id)
    {
        return $this->conexao->executarSQL("select * from cidades where id =".$id)->rowCount() > 0;
    }

    public function existsName($name)
    {
        return $this->conexao->executarSQL("select * from cidades where nome = '" . $name . "'")->rowCount() > 0;
    }
}