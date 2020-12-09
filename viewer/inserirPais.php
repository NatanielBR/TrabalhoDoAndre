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
            <label for="inputPaises">Nome do pais: </label><input id="inputPaises" type="text" name="nome" list="paises"/>
            <br>
            <input type="hidden" name="obj" value="pais">
            <input type="hidden" name="type" value="form">
            <input type="hidden" name="action" value="inserir">
            <input type="submit" value="Cadastrar">
        </form>
    </body>
</html>