<?php
require_once "../conexao.php";

$resultado = $conexao->query("SELECT * FROM produtos ORDER BY codigo_produto ASC");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>CRUD de Produtos</title>
</head>
<body>
    <h1>Lista de Produtos</h1>

    <a href="cadastrar_produto.php">Cadastrar novo produto</a>

    <br><br>

    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>Código</th>
            <th>Imagem</th>
            <th>Título</th>
            <th>Valor</th>
            <th>Estoque</th>
            <th>Ações</th>
        </tr>
            <?php while ($produto= $resultado->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $produto["codigo_produto"]; ?></td>
                    <td>
                        <?php if (!empty($produto["imagem"])): ?>
                            <img src="imagem.php?codigo_produto=<?php echo $produto["codigo_produto"]; ?>" width="80" height="80" style="object-fit: cover;">
                        <?php else: ?>
                            <span style="color: #999;">Sem imagem</span>
                        <?php endif; ?>
                    </td>
                    <td><?php echo $produto["titulo"]; ?></td>
                    <td>R$ <?php echo number_format($produto["valor"], 2, ',', '.'); ?></td>
                    <td><?php echo $produto["estoque"]; ?></td>
                    <td>
                        <a href="atualizar.php?codigo_produto=<?php echo $produto["codigo_produto"]; ?>">Editar</a>
                        |
                        <a href="excluir_produto.php?codigo_produto=<?php echo $produto["codigo_produto"]; ?>"
                           onclick="return confirm('Tem certeza que deseja excluir este produto?');">Excluir</a>
                    </td>
                </tr>
            <?php endwhile; ?>
    </table>
</body>
</html>
<?php $conexao->close(); ?>
