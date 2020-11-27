<?php


class Conexao
{
    private $host = "localhost";
    private $user = "userProjeto";
    private $pass = "54321qwerty";
    private $db = "projeto_andre";

    private $conexao;

    /**
     * Conexao constructor.
     */
    public function __construct()
    {
        $this->conexao = new PDO( 'mysql:host=' . $this->host . ';dbname=' . $this->db, $this->user, $this->pass );
    }

    /**
     * Metodo para executar um SQL, indepentende de ser um Select ou um delete por exemplo.
     * @param $sql String O comando SQL
     * @return false|int|PDOStatement False caso dê algum erro, objeto PDO caso seja um comando Select com os resultados e
     * numero sendo a quantidade de linhas afetadas.
     */
    public function executarSQL($sql){
        if ($this->isSelectCommand($sql)){
            return $this->conexao->query($sql);
        }else{
            return $this->conexao->exec($sql);
        }
    }

    /**
     * Metodo para:<br>
     * Iniciar uma transação<br>
     * Executar um comando na transação<br>
     * Encerrar e comitar a transação<br>
     * @param $sql String Para abrir uma transação informe True, caso queria fechar informe False. Caso queira executar um
     * comando simplesmente escreva o comando.
     * @return bool|int|PDOStatement Boolean caso dê algum erro, int ou PDO de acordo com o metodo executarSQL.
     */
    public function executarBatch($sql){
        if ($sql === true){
            return $this->conexao->beginTransaction();

        }else if ($sql === false){
            return $this->conexao->commit();
        }
        return $this->executarSQL($sql);
    }

    /**
     * Metodo para descobrir se é um comando SQL Select
     * @param $sql String O comando SQL
     * @return false|int False caso não seja ou algum numero caso seja, esse numero será considerado
     * um true em um if.
     */
    public function isSelectCommand($sql){
        $resultado = strpos(strtolower($sql), "select");
        if (is_numeric($resultado)){
            return true;
        }else{
            return false;
        }
    }
}