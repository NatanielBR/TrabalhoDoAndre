<?php


abstract class AbsAPI
{
    /**
     * Metodo para retornar o nome da API usado na requisição.
     * @return string nome da api para requisição.
     */
    public abstract function getAPIName();

    /**
     * Comando GET para listar os arquivos do banco de dados.<br>
     * Exemplo de uma requisição:<br>
     * /api/postAPI?listar<br>
     *
     * Exemplo de uma resposta:<br>
     * [
     * {id=10,texto="Teste-Exemplo 1"},
     * {id=11,texto="Teste-Exemplo 2"},
     * {id=12,texto="Teste-Exemplo 3"},
     * {id=13,texto="Teste-Exemplo 4"}
     * ]
     *
     * @return string JSON contendo a resposta da requisição.
     */
    public abstract function listar();

    /**
     * Comando GET para remover um id do banco de dados.<br>
     * Exemplo de uma requisição:<br>
     * /api/postAPI?remover&id=10<br>
     *
     * Exemplo de uma resposta 200:<br>
     * {
     * codigo=200, status="Post removido com sucesso!"
     * }
     * Exemplo de uma resposta 404:<br>
     * {
     *  codigo=404, status="Post não encontrado!"
     * }
     * @return string JSON contendo a resposta da requisição.
     */
    public abstract function remover();

    /**
     * Comando POST para inserir os dados para um banco de dados.<br>
     * Exemplo de requisição GET:<br>
     * /api/postAPI?inserir<br>
     * Exemplo de dados POST:<br>
     * {
     * id=20, texto="Teste de POST"
     * }
     * Exemplo de resposta 200:<br>
     * {
     * codigo=200, status="Post inserido com sucesso!"
     * }
     * Exemplo de resposta 409:<br>
     * {
     * codigo=409, status="Post já existe no sistema!"
     * }
     * Exemplo de resposta 400:<br>
     * {
     * codigo=400, status="Post foi recusado por conter problemas!", problemas="Texto maior que o limite!;"
     * }
     * @return string JSON contendo a resposta da requisição.
     */
    public abstract function inserir();

    /**
     * Comando POST para atualizar um item no banco de dados.<br>
     * Exemplo de requisição:<br>
     * /api/postAPI?atualizar<br>
     *
     * Exemplo de dados POST:<br>
     * {
     * id=20, texto="Teste de POST"
     * }
     *
     * Exemplo de resposta 200:<br>
     * {
     * codigo=200, status="Post atualizado com sucesso!"
     * }
     *
     * Exemplo de resposta 404:<br>
     * {
     * codigo=404, status="Post recusado por conter problemas!", problemas="Texto maior que o limite!;"
     * }
     *
     * Exemplo de resposta 400:<br>
     * {
     * codigo=400, status="Post não atualizado por não existir!"
     * }
     * @return string JSON contendo a resposta da requisição.
     */
    public abstract function atualizar();

    /**
     * Metodo para fazer um parser de um array para um objeto
     * @template T
     * @param $arr array um Array com seus dados, ex: $_GET
     * @param {T} $obj um objeto já instanciado.
     * @return {T} O mesmo objeto instanciado porem com os atributos preenchidos.
     */
    protected function tryParseArrayToObj($arr, $obj)
    {
//        var_dump(get_class_vars(get_class($obj)));
        foreach (get_class_vars(get_class($obj)) as $var => $value) {
            if (key_exists($var, $arr)) {
                $obj->{$var} = $arr[$var];
            }
        }
        return $obj;
    }

    /**
     * Metodo para exibir uma mensagem em JSON.
     * @param $code int status http (tente ser o mais fiel possivel)
     * @param $status string mensagem basica de erro.
     * @param array $extra parametros extras para ser exibido.
     */
    protected function reportar($code, $status, $extra = [])
    {
        $dados['code'] = $code;
        $dados['status'] = $status;
        foreach ($extra as $key => $value) {
            if (key_exists($key, $dados)) {
                $dados[$key] = $dados[$key] . ", " . $value;
            } else {
                $dados[$key] = $value;
            }
        }
        http_response_code($dados['code']);
        echo(json_encode($dados));
    }

    /**
     * Metodo para checar se o parametro GET foi atendido. Caso sim, o script
     * executa normalmente, caso não ele reporta e sai.
     * @param $parametro String parametro para ser checado.
     */
    protected function condicaoGet($parametro){
        if (!isset($_GET[$parametro])){
            $this->reportar(500, "Parametro obrigatorio : ".$parametro);
            exit(-1);
        }
    }

}