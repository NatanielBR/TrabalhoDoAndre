<?php
include_once "api/AbsAPI.php";
include_once "dao/entitys/PaisReporsitorio.php";

class FormAPI extends AbsAPI
{
    private $reporsitorioPais;

    /**
     * FormAPI constructor.
     */
    public function __construct()
    {

        $this->reporsitorioPais = new PaisReporsitorio();
    }

    public function getAPIName()
    {
        return "form";
    }

    public function listar()
    {

    }

    public function remover()
    {
        // TODO: Implement remover() method.
    }

    public function inserir()
    {
        $this->condicaoGet("obj");
        $this->condicaoGet("nome");
        switch ($_GET['obj']){
            case "pais":
                if ($this->reporsitorioPais->existsName($_GET['nome'])){
                    $this->reportar(409, "País já existe no banco de dados");
                }else{
                    header("Location:api.php?type=pais&action=inserir&nome=".$_GET['nome']."&id=".rand());
                }
                break;
        }
    }

    public function atualizar()
    {
        // TODO: Implement atualizar() method.
    }
}