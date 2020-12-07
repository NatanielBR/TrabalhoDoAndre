<?php
include_once "api/AbsAPI.php";
include_once "dao/entitys/PaisReporsitorio.php";
include_once "dao/entitys/EstadoReporsitorio.php";
include_once "dao/entitys/Estado.php";

class EstadoAPI extends AbsAPI
{

    private $reporsitorio;
    private $reporsitorio2;

    /**
     * EstadoAPI constructor.
     */
    public function __construct()
    {
        $this->reporsitorio = new EstadoReporsitorio();
        $this->reporsitorio2 = new PaisReporsitorio();
        header('Content-Type: application/json');
    }


    public function getAPIName()
    {
        return "estado";
    }

    public function listar()
    {
        echo json_encode($this->reporsitorio->findAll()->fetchAll(PDO::FETCH_CLASS, "estado"));
    }

    public function remover()
    {
        $this->condicaoGet('id');
        $id = $_GET['id'];
        if ($this->reporsitorio->exists($id)){
            $this->reporsitorio->delete($id);
            $this->reportar(200, "Estado removido com sucesso!");
        }else{
            $this->reportar(404, "Estado não existe!");
        }
    }

    public function inserir()
    {
        $estado = $this->createFromGet();

        if ($this->reporsitorio->exists($estado->id)){
            $this->reportar(409, "Estado já existe no banco de dados!");
        }else{
            if ($this->reporsitorio2->exists($estado->pais_id)){
                $this->reporsitorio->saveOrUpdate($estado);
                $this->reportar(200, "Estado salva com sucesso!");
            }else{
                $this->reportar(404, "País não existe, primeiro crie um país para depois criar uma cidade!");
            }
        }

    }

    public function atualizar()
    {
        $estado = $this->createFromGet();

        if ($this->reporsitorio->exists($estado->id)){
            $this->reporsitorio->saveOrUpdate($estado);
            $this->reportar(200, "Estado atualizado com sucesso!");
        }else{
            $this->reportar(404, "Estado não existe no banco de dados!");
        }

    }

    /**
     * Metodo que valida e cria um Estado com base no $_GET
     * @return Estado
     */
    private function createFromGet(){
        $this->condicaoGet('id');
        $this->condicaoGet('nome');
        $this->condicaoGet('descricao');
        $this->condicaoGet('pais_id');


        $estado = new Estado();
        return $this->tryParseArrayToObj($_GET, $estado);
    }
}
