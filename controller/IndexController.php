<?php
include "./dao/entitys/PaisReporsitorio.php";
include "./dao/entitys/EstadoReporsitorio.php";

class IndexController
{
    private $reporsitorioPais;
    private $reporsitorioEstado;

    /**
     * IndexController constructor.
     */
    public function __construct()
    {
        $this->reporsitorioPais = new PaisReporsitorio();
        $this->reporsitorioEstado = new EstadoReporsitorio();
    }

    public function normal()
    {
        include "./viewer/Index.html";
    }

    public function novo()
    {
        if (isset($_GET['oq'])) {
            switch ($_GET['oq']) {
                case "pais":
                    include "./viewer/inserirPais.php";
//                    $this->includeWithVariables("./viewer/inserirPais.php", ['lista'=>$lista]);
                    break;
                case "estado":
                    if (isset($_GET['pais'])) {
                        include "./viewer/inserirEstado2.php";
                    } else {
                        $lista = $this->reporsitorioPais->findAll()->fetchAll();
                        include "./viewer/inserirEstado.php";

                    }
//                    $this->includeWithVariables("./viewer/inserirPais.php", ['lista'=>$lista]);
                    break;
                case "cidade":
                    if (isset($_GET['estado'])){
                        $pais = $this->reporsitorioPais->findByName($_GET['pais']);
                        $estado = $this->reporsitorioEstado->findByName($_GET['estado']);
                        $idPais = $pais->id;
                        $idEstado = $estado->id;
                        include "./viewer/inserirCidade3.php";
                    }else if (isset($_GET['pais'])) {
                        $pais = $this->reporsitorioPais->findByName($_GET['pais']);
                        $lista = $this->reporsitorioEstado->findAllByPais( $pais->id
                            )->fetchAll();
                        include "./viewer/inserirCidade2.php";
                    } else {
                        $lista = $this->reporsitorioPais->findAll()->fetchAll();
                        include "./viewer/inserirCidade.php";

                    }
//                    $this->includeWithVariables("./viewer/inserirPais.php", ['lista'=>$lista]);
                    break;
                default:
                    include "./viewer/inserir.html";
                    break;
            }
        } else {
            include "./viewer/inserir.html";
        }
    }

    function includeWithVariables($filePath, $variables = array(), $print = true)
    {
        $output = NULL;
        if (file_exists($filePath)) {
            // Extract the variables to a local namespace
            extract($variables);

            // Start output buffering
            ob_start();

            // Include the template file
            include $filePath;

            // End buffering and return its contents
            $output = ob_get_clean();
        }
        if ($print) {
            print $output;
        }
        return $output;

    }
}