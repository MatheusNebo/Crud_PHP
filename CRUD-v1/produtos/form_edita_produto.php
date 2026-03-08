<?php
require_once __DIR__ . "/../conexao.php";
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Produto</title>
    <link rel="stylesheet" href="/aula_php/CRUD-v1/style.css">
<body>
   <header class="header">
        <h1>🔧 Sistema de Gerenciamento de Produtos</h1>
        
        <nav class="nav-menu">
            <a href="/../produtos.php" class="nav-link active">📋 Listar Produtos</a>
            <a href="/../usuarios.php" class="nav-link">📋 Listar Usuários</a>
            <a href="" class="nav-link">📊 Relatórios (prox passos)</a>
        </nav>
    </header>

    <!-- Container principal com área de conteúdo -->
    <main class="main-container">
        <div class="content-area">
            <div class="content-header">
                <h2>Editar Produto</h2>
            </div>
    
            <form method="POST" action="atualizar.php" enctype="multipart/form-data">
                <input type="hidden" name="codigo_produto" value="<?php echo htmlspecialchars($produto["codigo_produto"]); ?>">

                <label>Título:</label><br>
                <input type="text" name="titulo" value="<?php echo htmlspecialchars($produto["titulo"]); ?>" required><br><br>

                <label>Valor:</label><br>
                <input type="number" name="valor" step="0.01" min="0" value="<?php echo htmlspecialchars($produto["valor"]); ?>" required><br><br>

                <label>Estoque:</label><br>
                <input type="number" name="estoque" min="0" value="<?php echo htmlspecialchars($produto["estoque"]); ?>" required><br><br>

                <?php if (!empty($produto["imagem"])): ?>
                    <div style="position: relative; display: inline-block; margin-bottom: 10px;">
                        <img src="imagem.php?codigo_produto=<?php echo htmlspecialchars($produto["codigo_produto"]); ?>" width="150">
                        
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

        </div>
    </main>
    
     <!-- Footer opcional -->
    <footer style="background-color: #2c3e50; color: white; text-align: center; padding: 1rem; margin-top: auto;">
        <p style="opacity: 0.8;">&copy; 2026 - Sistema CRUD v1.0</p>
    </footer>

    <script>
        // script para marcar o link ativo baseado na URL atual
        document.addEventListener('DOMContentLoaded', function() {
            const currentPage = window.location.pathname.split('/').pop();
            const navLinks = document.querySelectorAll('.nav-link');
            
            navLinks.forEach(link => {
                const linkPage = link.getAttribute('href');
                if (linkPage === currentPage) {
                    link.classList.add('active');
                }
            });
        });
    </script>
</body>
</html>

