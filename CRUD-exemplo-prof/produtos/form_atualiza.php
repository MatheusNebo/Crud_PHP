<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Produto</title>
</head>
<body>
    <h1>Editar Produto (Código: <?php echo $produto["codigo"]; ?>)</h1>

    <form method="POST" action="atualizar.php" enctype="multipart/form-data">
        <input type="hidden" name="codigo" value="<?php echo $produto["codigo"]; ?>">

        <label>Título:</label><br>
        <input type="text" name="titulo" value="<?php echo htmlspecialchars($produto["titulo"]); ?>" required><br><br>

        <label>Valor:</label><br>
        <input type="number" name="valor" step="0.01" min="0" value="<?php echo $produto["valor"]; ?>" required><br><br>

        <label>Estoque:</label><br>
        <input type="number" name="estoque" min="0" value="<?php echo $produto["estoque"]; ?>" required><br><br>

        <?php if (!empty($produto["imagem"])): ?>
            <div style="position: relative; display: inline-block; margin-bottom: 10px;">
                <img src="imagem.php?codigo=<?php echo $produto["codigo"]; ?>" width="150">
                <button type="button" onclick="removerImagem()" title="Excluir imagem"
                    style="position: absolute; top: 2px; right: 2px; background: rgba(220,53,69,0.9); color: white; border: none; border-radius: 50%; width: 28px; height: 28px; cursor: pointer; font-size: 16px; line-height: 1;">
                    &#128465;
                </button>
            </div>
            <br>
        <?php endif; ?>
        <input type="hidden" name="remover_imagem" id="remover_imagem" value="0">
        <input type="file" name="imagem" accept="image/*" id="input_imagem">
        <small>(Deixe vazio para manter a imagem atual)</small><br><br>

        <script>
        function removerImagem() {
            if (confirm("Tem certeza que deseja excluir a imagem?")) {
                document.getElementById("remover_imagem").value = "1";
                document.getElementById("input_imagem").closest("form").querySelector("div")?.remove();
            }
        }
        </script>

        <button type="submit">Salvar</button>
    </form>

    <br>
    <a href="index.php">Voltar para a lista</a>
</body>
</html>
