<?php
include_once "api/AbsAPI.php";
include_once "dao/entitys/CidadeReporsitorio.php";
include_once "dao/entitys/EstadoReporsitorio.php";
include_once "dao/entitys/Cidade.php";

class CidadeAPI extends AbsAPI
{

    private $reporsitorio;
    private $reporsitorio2;

    /**
     * CidadeAPI constructor.
     */
    public function __construct()
    {
        $this->reporsitorio = new CidadeReporsitorio();
        $this->reporsitorio2 = new EstadoReporsitorio();
        header('Content-Type: application/json');
    }


    public function getAPIName()
    {
        return "cidade";
    }

    public function listar()
    {
        echo json_encode($this->reporsitorio->findAll()->fetchAll(PDO::FETCH_CLASS, "cidade"));
    }

    public function remover()
    {
        $this->condicaoGet('id');
        $id = $_GET['id'];
        if ($this->reporsitorio->exists($id)){
            $this->reporsitorio->delete($id);
            $this->reportar(200, "Cidade removida com sucesso!");
        }else{
            $this->reportar(404, "Cidade não existe!");
        }
    }

    public function inserir()
    {
        $cidade = $this->createFromGet();

        if ($this->reporsitorio->exists($cidade->cidade_id)){
            $this->reportar(409, "Cidade já existe no banco de dados!");
        }else{
            if ($this->reporsitorio2->exists($cidade->estado_id)){
                $this->reporsitorio->saveOrUpdate($cidade);
                $this->reportar(200, "Cidade salva com sucesso!");
            }else{
                $this->reportar(404, "Estado não existe, primeiro crie um estado para depois criar uma cidade!");
            }
        }

    }

    public function atualizar()
    {
        $cidade = $this->createFromGet();

        if ($this->reporsitorio->exists($cidade->cidade_id)){
            $this->reporsitorio->saveOrUpdate($cidade);
            $this->reportar(200, "Cidade atualizado com sucesso!");
        }else{
            $this->reportar(404, "Cidade não existe no banco de dados!");
        }

    }

    /**
     * Metodo que valida e cria uma Cidade com base no $_GET
     * @return Cidade
     */
    private function createFromGet(){
        $this->condicaoGet('id');
        $this->condicaoGet('nome');
        $this->condicaoGet('descricao');
        $this->condicaoGet('estado_id');


        $cidade = new Cidade();
        return $this->tryParseArrayToObj($_GET, $cidade);
    }
}