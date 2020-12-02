<?php

include_once "dao/entitys/PostReporsitory.php";
include_once "dao/entitys/Post.php";
include_once "AbsAPI.php";

class postAPI extends AbsAPI
{
    private $reporsitorio;

    /**
     * postAPI constructor.
     */
    public function __construct()
    {
        $this->reporsitorio = new PostReporsitory();
        header('Content-Type: application/json');
    }


    public function listar()
    {
        echo json_encode($this->reporsitorio->findAll()->fetchAll(PDO::FETCH_CLASS, "post"));
    }

    public function remover()
    {
        $status = [];
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            if ($this->reporsitorio->exists($id)) {
                $this->reporsitorio->delete($id);
                $status['code'] = 200;
                $status['status'] = "Post apagado com sucesso!";
            } else {
                $status['code'] = 404;
                $status['status'] = "Post não exsite no banco de dados!";
            }
        } else {
            $status['code'] = 400;
            $status['status'] = "Esta faltando um parametro obrigatorio!";
            $status['parametros'] = "id";
        }
        http_response_code($status['code']);
        echo json_encode($status);
    }

    public function inserir()
    {
        if (count($_POST) > 0) {
            $post = $this->tryParsePostToObj($_POST, new Post());
            $post->atualizado = new DateTime();
            if (isset($post->texto)) {
                if (!isset($post->id) || $this->reporsitorio->exists($post->id)) {
                    $this->reportar(409, 'Post já se existe no banco de dados!');
                } else {
                    $resultado = $this->reporsitorio->saveOrUpdate($post);
                    if (!$resultado) {
                        $this->reportar(500, "Erro ao salvar o Post!");
                    } else {
                        $this->reportar(201, 'Post salvo com sucesso!', ['post' => $post]);
                    }
                }
            } else {
                $this->reportar(400, 'Post recusado por dados obrigatorios não estar preenchidos!', ['parametros' => 'texto']);
            }
        } else {
            $this->reportar(400, "Nenhum dado foi recebido pelo metodo Post!");
        }
    }

    public function atualizar()
    {
        if (count($_POST) > 0) {
            $post = $this->tryParsePostToObj($_POST, new Post());
            if (isset($post->texto) && isset($post->id)) {
                if (!$this->reporsitorio->exists($post->id)) {
                    $this->reportar(409, 'Post não existe no banco de dados!');
                } else {
                    $this->reporsitorio->saveOrUpdate($post);
                    $this->reportar(201, 'Post atualizado com sucesso!', ['post' => $post]);
                }
            } else {
                $this->reportar(400, 'Post recusado por dados obrigatorios não estar preenchidos!');
            }
        } else {
            $this->reportar(400, "Nenhum dado foi recebido pelo metodo Post!");
        }
    }

    public function getAPIName()
    {
        return "post";
    }
}

