<?php
require_once "../conexao.php";

$resultado = $conexao->query("SELECT * FROM usuarios ORDER BY codigo ASC");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>CRUD de Usuários</title>
</head>
<body>
    <h1>Lista de Usuários</h1>

    <a href="cadastrar.php">Cadastrar novo usuário</a>

    <br><br>

    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>Código</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Administrador</th>
            <th>Ações</th>
        </tr>
            <?php while ($usuario = $resultado->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $usuario["codigo"]; ?></td>
                    <td><?php echo $usuario["nome"]; ?></td>
                    <td><?php echo $usuario["email"]; ?></td>
                    <td><?php echo $usuario["administrador"] ? "Sim" : "Não"; ?></td>
                    <td>
                        <a href="editar.php?codigo=<?php echo $usuario["codigo"]; ?>">Editar</a>
                        |
                        <a href="excluir.php?codigo=<?php echo $usuario["codigo"]; ?>"
                           onclick="return confirm('Tem certeza que deseja excluir este usuário?');">Excluir</a>
                    </td>
                </tr>
            <?php endwhile; ?>
    </table>
</body>
</html>
<?php $conexao->close(); ?>
