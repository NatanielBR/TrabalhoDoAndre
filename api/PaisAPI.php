<?php
include_once "AbsAPI.php";
include_once "dao/entitys/Pais.php";
include_once "dao/entitys/PaisReporsitorio.php";

class PaisAPI extends AbsAPI
{

    private $reporsitorio;

    /**
     * PaisAPI constructor.
     */
    public function __construct()
    {
        $this->reporsitorio = new PaisReporsitorio();
        header('Content-Type: application/json');
    }


    public function getAPIName()
    {
        return "pais";
    }

    public function listar()
    {
        echo json_encode($this->reporsitorio->findAll()->fetchAll(PDO::FETCH_CLASS, "pais"));
    }

    public function remover()
    {
        $this->condicaoGet('id');
        $id = $_GET['id'];
        if ($this->reporsitorio->exists($id)){
            $this->reporsitorio->delete($id);
            $this->reportar(200, "Pais removido com sucesso!");
        }else{
            $this->reportar(404, "Pais não existe!");
        }
    }

    public function inserir()
    {
        $pais = $this->createFromGet();

        if ($this->reporsitorio->exists($pais->id)){
            $this->reportar(409, "Pais já existe no banco de dados!");
        }else{
            if ($this->reporsitorio->exists($pais->id)){
                $this->reporsitorio->saveOrUpdate($pais);
                $this->reportar(200, "Pais salvo com sucesso!");
            }else{
                $this->reportar(404, "Pais não existe!");
            }
        }

    }

    public function atualizar()
    {
        $pais = $this->createFromGet();

        if ($this->reporsitorio->exists($pais->id)){
            $this->reporsitorio->saveOrUpdate($pais);
            $this->reportar(200, "Pais atualizado com sucesso!");
        }else{
            $this->reportar(404, "Pais não existe no banco de dados!");
        }

    }

    /**
     * Metodo que valida e cria um Pais com base no $_GET
     * @return Pais
     */
    private function createFromGet(){
        $this->condicaoGet('id');
        $this->condicaoGet('nome');
        $this->condicaoGet('descricao');


        $pais = new Pais();
        return $this->tryParseArrayToObj($_GET, $pais);
    }
}
