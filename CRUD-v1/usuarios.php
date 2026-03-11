<?php
require_once __DIR__ . "../conexao.php";

$resultado = $conexao->query("SELECT * FROM usuarios ORDER BY codigo_usuario ASC");
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Sistema CRUD - Produtos</title>

</head>
<body>
    <!-- header com links de navegação -->
    <header class="header">
        <h1>🔧 Sistema de Gerenciamento de Produtos</h1>
        
        <nav class="nav-menu">
            <a href="/aula_php/CRUD-v1/produtos.php" class="nav-link active">📋 Listar Produtos</a>
            <a href="/aula_php/CRUD-v1/usuarios.php" class="nav-link">📋 Listar Usuários</a>
            <a href="/aula_php/CRUD-v1/relatorios/importar_csv.php" class="nav-link">📊 Relatórios (prox passos)</a>
        </nav>
    </header>

    <!-- Container principal com área de conteúdo -->
    <main class="main-container">
        <div class="content-area">
            <div class="content-header">
                <h2>Lista de Usuários</h2>
                <a href="/aula_php/CRUD-v1/usuarios/form_cadastra_usuario.php" class="btn-novo">+ Novo Usuário</a>
            </div>

            <!-- conteudo da página -->
            <div class="content-body">
               
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background-color: #f8f9fa; border-bottom: 2px solid #dee2e6;">
                            <th style="padding: 12px; text-align: left;">Código</th>
                            <th style="padding: 12px; text-align: left;">Nome</th>
                            <th style="padding: 12px; text-align: left;">Email</th>
                            <th style="padding: 12px; text-align: left;">Administrador</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($usuario= $resultado->fetch_assoc()): ?>
                        <tr style="border-bottom: 1px solid #eee;">
                            <td style="padding: 12px;"><?php echo $usuario['codigo_usuario']; ?></td>
                            <td style="padding: 12px;"><?php echo $usuario['nome']; ?></td>
                            <td style="padding: 12px;"><?php echo $usuario['email']; ?></td>
                            <td style="padding: 12px;">
                                <?php if ($usuario['administrador'] == 1): ?>
                                    <span style="color: #27ae60;">Sim</span>
                                <?php else: ?>
                                    <span style="color: #ff0000;">Não</span>
                                <?php endif; ?>
                            </td>
                            <td style="padding: 12px;">
                                <a href="/aula_php/CRUD-v1/usuarios/editar_usuario.php?codigo_usuario=<?php echo $usuario['codigo_usuario']; ?>" style="color: #3498db; text-decoration: none; margin-right: 10px;">✏️ Editar</a>
                                <a href="/aula_php/CRUD-v1/usuarios/excluir_usuario.php?codigo_usuario=<?php echo $usuario['codigo_usuario']; ?>" 
                                   style="color: #e74c3c; text-decoration: none;"
                                   onclick="return confirm('Tem certeza que deseja excluir?')">🗑️ Excluir</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Footer opcional -->
    <footer style="background-color: #2c3e50; color: white; text-align: center; padding: 1rem; margin-top: auto;">
        <p style="opacity: 0.8;">&copy; 2026 - Sistema CRUD v1.0</p>
    </footer>

    <script>
        // Script para marcar o link ativo baseado na URL atual
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
<?php $conexao->close(); ?>
