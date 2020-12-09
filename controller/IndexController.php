<?php
include "./dao/entitys/PaisReporsitorio.php";

class IndexController
{

    /**
     * IndexController constructor.
     */
    public function __construct()
    {
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