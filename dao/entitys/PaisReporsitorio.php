<?php
include_once "dao/IReporsitory.php";
include_once "dao/Conexao.php";
include_once "dao/entitys/Pais.php";

class PaisReporsitorio implements IReporsitory
{

    private $conexao;
    /**
     * PaisReporsitorio constructor.
     */
    public function __construct()
    {
        $this->conexao = new Conexao();
        $this->conexao->executarSQL(Pais::getTableSQL());
    }

    public function findAll()
    {
        return $this->conexao->executarSQL("select * from paises");
    }

    /**
     * @inheritDoc
     * @return Pais
     */
    public function findById($id)
    {
        $result = $this->conexao->executarSQL("select * from paises where id=" . $id);
        return $result->fetchObject("pais");
    }

    /**
     * @inheritDoc
     * @return Pais
     */
    public function findByName($name)
    {
        $result = $this->conexao->executarSQL("select * from paises where nome='" . $name. "'");
        return $result->fetchObject("pais");
    }

    public function delete($id)
    {
        return $this->conexao->executarSQL("delete from paises where id=" . $id);
    }

    public function saveOrUpdate($entity)
    {
        if ($entity instanceof Pais){
            return $this->conexao->executarSQL("INSERT INTO paises VALUES (".$entity->id.",'".$entity->nome."') ON DUPLICATE KEY UPDATE nome = '".$entity->nome."'");
        }else{
            return false;
        }
    }

    public function exists($id)
    {
        return $this->conexao->executarSQL("select * from paises where id = ".$id)->rowCount()>0;
    }

    public function existsName($name)
    {
        return $this->conexao->executarSQL("select * from paises where nome = '".$name."'")->rowCount()>0;
    }
}