<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Mundanos - Painel de criação de paises</title>
    </head>
    <body>
        <h1>Painel de criação de paises</h1>
        <hr>
        <form action="api.php" method="get">
            <label for="inputPaises">Selecione o pais: </label>
            <select name="pais">
                <?php
                echo "<option> " . $_GET['pais'] . "\n";

                ?>
            </select>
            <br>
            <label for="inputEstado">Nome do estado: </label><input id="inputEstado" type="text" name="nome"/>
            <br>
            <input type="hidden" name="obj" value="estado">
            <input type="hidden" name="type" value="form">
            <input type="hidden" name="action" value="inserir">
            <input type="submit" value="Cadastrar">
        </form>
    </body>
</html>