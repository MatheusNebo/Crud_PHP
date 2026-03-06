<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Produto</title>
</head>
<body>
    <h1>Cadastrar Produto</h1>
    <form method="POST" action="cadastrar.php" enctype="multipart/form-data">
        <label>Título:</label><br>
        <input type="text" name="titulo" required><br><br>

        <label>Valor:</label><br>
        <input type="number" name="valor" step="0.01" min="0" required><br><br>

        <label>Estoque:</label><br>
        <input type="number" name="estoque" min="0" required><br><br>

        <label>Imagem:</label><br>
        <input type="file" name="imagem" accept="image/*"><br><br>

        <button type="submit">Cadastrar</button>
    </form>

    <br>
    <a href="index.php">Voltar para a lista</a>
</body>
</html>
