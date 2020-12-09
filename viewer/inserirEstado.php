<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Mundanos - Painel de criação de paises</title>
    </head>
    <body>
        <h1>Painel de criação de paises</h1>
        <hr>
        <form action="index.php" method="get">
            <label for="inputPaises">Selecione o pais: </label>
            <select name="pais">
                <?php
                foreach ($lista as $item) {
                    echo "<option> " . $item['nome'] . "\n";
                }
                ?>
            </select>
            <br>
            <input type="hidden" name="obj" value="estado">
            <input type="hidden" name="act" value="novo">
            <input type="hidden" name="oq" value="estado">
            <input type="submit" value="Selecionar">
        </form>
    </body>
</html>