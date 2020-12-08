<?php
include_once "AbsAPI.php";
include_once "dao/entitys/Pais.php";
include_once "dao/entitys/PaisReporsitorio.php";

class PaisAPI extends AbsAPI
{

    private $reporsitorio;

    /**
     * EstadoAPI constructor.
     */
    public function __construct()
    {
        $this->reporsitorio = new PaisReporsitorio();
        header('Content-Type: application/json');
    }


    public function getAPIName()
    {
        return "País";
    }

    public function listar()
    {
        echo json_encode($this->reporsitorio->findAll()->fetchAll(PDO::FETCH_CLASS, "País"));
    }

    public function remover()
    {
        $this->condicaoGet('id');
        $id = $_GET['id'];
        if ($this->reporsitorio->exists($id)){
            $this->reporsitorio->delete($id);
            $this->reportar(200, "País removido com sucesso!");
        }else{
            $this->reportar(404, "País não existe!");
        }
    }

    public function inserir()
    {
        $pais = $this->createFromGet();

        if ($this->reporsitorio->exists($pais->id)){
            $this->reportar(409, "País já existe no banco de dados!");
        }else{
            if ($this->reporsitorio2->exists($pais->pais_id)){
                $this->reporsitorio->saveOrUpdate($pais);
                $this->reportar(200, "País salvo com sucesso!");
            }else{
                $this->reportar(404, "País não existe!");
            }
        }

    }

    public function atualizar()
    {
        $pais = $this->createFromGet();

        if ($this->reporsitorio->exists($pais->id)){
            $this->reporsitorio->saveOrUpdate($pais);
            $this->reportar(200, "País atualizado com sucesso!");
        }else{
            $this->reportar(404, "País não existe no banco de dados!");
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


        $pais = new Pais();
        return $this->tryParseArrayToObj($_GET, $pais);
    }
}
