<?php
include_once "dao/entitys/Post.php";
include_once "dao/Conexao.php";
include_once "dao/IReporsitory.php";

class PostReporsitory implements IReporsitory
{
    private $conexao;

    /**
     * PostReporsitory constructor.
     */
    public function __construct()
    {
        $this->conexao = new Conexao();
        $this->conexao->executarSQL(Post::getTableSQL());
    }

    public function findAll()
    {
        return $this->conexao->executarSQL("select * from posts");
    }

    /**
     * Metodo para obter um post baseado no id.
     * @param int $id o id
     * @return Post
     */
    public function findById($id)
    {
        $result = $this->conexao->executarSQL("select * from posts where id=" . $id);
        return $result->fetchObject("post");
    }

    public function delete($id)
    {
        return $this->conexao->executarSQL("delete from posts where id=" . $id);
    }

    public function saveOrUpdate($entity)
    {
        if ($entity instanceof Post) {
            if ($entity->atualizado instanceof DateTime) {
                $entity->atualizado = $entity->atualizado->format("yy-m-d");
            }
            return $this->conexao->executarSQL("INSERT INTO posts VALUES (" . $entity->id . ",'" . $entity->texto . "', '" . $entity->atualizado . "') ON DUPLICATE KEY UPDATE
   texto = '" . $entity->texto . "', atualizado = '" . $entity->atualizado . "'");
        } else {
            return false;
        }
    }

    public function exists($id)
    {
        $resultado = $this->conexao->executarSQL("select * from posts where id=" . $id);
        return $resultado->rowCount() > 0;
    }
}