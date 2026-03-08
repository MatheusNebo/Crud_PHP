<?php
require_once __DIR__ . "/../conexao.php";
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Produto</title>
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
                <h2>Lista de Produtos</h2>
            </div>
    
            <form method="POST" action="cadastrar_produto.php" enctype="multipart/form-data">
                <label>Titulo:</label><br>
                <input type="text" name="titulo" required><br><br>

                <label>Valor:</label><br>
                <input type="number" name="valor" step="0.01" min="0" required><br><br>

                <label>Estoque:</label><br>
                <input type="number" name="estoque" min="0" required><br><br>

                <label>Imagem:</label><br>
                <input type="file" name="imagem" accept="image/*"><br><br>

                <button type="submit">Cadastrar Produto</button>
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

