<?php
include_once "dao/IReporsitory.php";
include_once "dao/Conexao.php";
include_once "dao/entitys/Estado.php";

class EstadoReporsitorio implements IReporsitory
{
    private $conexao;

    /**
     * EstadoReporsitorio constructor.
     */
    public function __construct()
    {
        $this->conexao = new Conexao();
        $this->conexao->executarSQL(Estado::getTableSQL());
    }


    public function findAll()
    {
        return $this->conexao->executarSQL("select * from estados");
    }

    /**
     * @inheritDoc
     * @return Estado
     */
    public function findById($id)
    {
        return $this->conexao->executarSQL("select * from estados where id = " . $id)->fetchObject('estado');
    }

    /**
     * @inheritDoc
     * @return Estado
     */
    public function findByName($name)
    {
        $result = $this->conexao->executarSQL("select * from estados where nome='" . $name . "'");
        var_dump($result);
        return $result->fetchObject("estado");
    }

    public function delete($id)
    {
        return $this->conexao->executarSQL("delete from estados where id = " . $id);
    }

    public function saveOrUpdate($entity)
    {
        if ($entity instanceof Estado) {
            return $this->conexao->executarSQL("INSERT INTO estados VALUES (" . $entity->id . ",'" . $entity->nome . "', " . $entity->pais_id . ") ON DUPLICATE KEY UPDATE nome = '" . $entity->nome . "', pais_id =" . $entity->pais_id);
        } else {
            return false;
        }
    }

    public function exists($id)
    {
        return $this->conexao->executarSQL("select * from estados where id =" . $id)->rowCount() > 0;
    }

    public function existsName($name)
    {
        return $this->conexao->executarSQL("select * from estados where nome = '" . $name . "'")->rowCount() > 0;
    }
}