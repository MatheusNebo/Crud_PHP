<?php
require_once __DIR__ . "/../conexao.php";
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Usuário</title>
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
                <h2>Lista de Usuarios</h2>
            </div>
    
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

