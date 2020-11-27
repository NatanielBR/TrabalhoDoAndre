<?php


interface IReporsitory
{
    /**
     * Metodo para retornar todos os itens de uma tabela.<br>
     * Normalmente se utiliza "select * from tableName".
     * @return PDOStatement O resultado.
     */
    public function findAll();

    /**
     * Metodo para buscar um unico indice de uma tabela baseado no id.<br>
     * Normalmente se utiliza "select * from tableName where idColumn=idValue".
     * @param $id int o id de um indice
     * @return PDOStatement o resultado.
     */
    public function findById($id);

    /**
     * Metodo para apagar uma entidade da tabela utilizando o seu id.<br>
     * Normalmente se utiliza: "delete from tableName where idColumn=idValue".
     * @param $id int
     * @return int
     */
    public function delete($id);

    /**
     * Metodo para salvar ou atualizar uma entidade. Alguns bancos de dados
     * é possivel utilizar utilizar em um unico comando, outros precisam executar varios comandos
     * na logica de verificar se existe, se não insere se sim atualiza.
     * @param $entity mixed A classe para ser salva.
     * @return int O numero de linhas afetadas.
     */
    public function saveOrUpdate($entity);

    /**
     * Metodo para saber se o id existe na tabela.
     * @param $id int O id.
     * @return bool True caso exista, false caso não.
     */
    public function exists($id);
}