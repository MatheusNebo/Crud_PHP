<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Usuário</title>
</head>
<body>
    <h1>Cadastrar Usuário</h1>
    <form method="POST" action="cadastrar.php">
        <label>Nome:</label><br>
        <input type="text" name="nome" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Senha:</label><br>
        <input type="password" name="senha" required><br><br>

        <label>
            <input type="checkbox" name="administrador" value="1">
            Administrador
        </label><br><br>

        <button type="submit">Cadastrar</button>
    </form>

    <br>
    <a href="lista_usuarios.php">Voltar para a lista</a>
</body>
</html>
