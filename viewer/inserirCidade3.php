<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Mundanos - Painel de criação de estados</title>
    </head>
    <body>
        <h1>Painel de criação de estados</h1>
        <hr>
        <form action="api.php" method="get">
            <label for="inputPaises">Selecione o pais: </label>
            <select name="pais">
                <?php
                echo "<option> " . $_GET['pais'] . "\n";

                ?>
            </select>
            <br>
            <label for="inputEstados">Selecione o estado: </label>
            <select name="estado">
                <?php
                echo "<option> " . $_GET['estado'] . "\n";

                ?>
            </select>
            <br>
            <label for="inputCidade">Nome da cidade: </label><input id="inputCidade" type="text" name="nome"/>
            <br>
            <label for="inputDescricao">Descricao: </label><textarea id="inputDescricao" type="text" name="descricao"> </textarea>
            <br>
            <input type="hidden" name="idPais" value=<?php echo "\"".$idPais."\""?>>
            <input type="hidden" name="idEstado" value=<?php echo "\"".$idEstado."\""?>>
            <input type="hidden" name="obj" value="cidade">
            <input type="hidden" name="type" value="form">
            <input type="hidden" name="action" value="inserir">
            <input type="submit" value="Cadastrar">
        </form>
    </body>
</html>