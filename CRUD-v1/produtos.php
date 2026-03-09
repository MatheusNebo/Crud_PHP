<?php
require_once __DIR__ . "../conexao.php";

$resultado = $conexao->query("SELECT * FROM produtos ORDER BY codigo_produto ASC");
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
    <!-- Header com links de navegação -->
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
                <a href="/aula_php/CRUD-v1/produtos/cadastrar_produto.php" class="btn-novo">+ Novo Produto</a>
            </div>

            <!-- conteudo da página (no caso do index a tabela) -->
            <div class="content-body">
               
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background-color: #f8f9fa; border-bottom: 2px solid #dee2e6;">
                            <th style="padding: 12px; text-align: left;">Código</th>
                            <th style="padding: 12px; text-align: left;">Imagem</th>
                            <th style="padding: 12px; text-align: left;">Título</th>
                            <th style="padding: 12px; text-align: left;">Valor</th>
                            <th style="padding: 12px; text-align: left;">Estoque</th>
                            <th style="padding: 12px; text-align: left;">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($produto = $resultado->fetch_assoc()): ?>
                        <tr style="border-bottom: 1px solid #eee;">
                            <td style="padding: 12px;"><?php echo $produto['codigo_produto']; ?></td>
                            <td style="padding: 12px;">
                                <?php if (!empty($produto["imagem"])): ?>
                                    <img src="/aula_php/CRUD-v1/produtos/imagem.php?codigo_produto=<?php echo $produto["codigo_produto"]; ?>" width="80" height="80" style="object-fit: cover; border-radius: 4px;">
                                <?php else: ?>
                                    <span style="color: #999;">Sem imagem</span>
                                <?php endif; ?>
                            </td>
                            <td style="padding: 12px;"><?php echo $produto['titulo']; ?></td>
                            <td style="padding: 12px;">R$ <?php echo number_format($produto['valor'], 2, ',', '.'); ?></td>
                            <td style="padding: 12px;"><?php echo $produto['estoque']; ?></td>
                            <td style="padding: 12px;">
                                <a href="/aula_php/CRUD-v1/produtos/editar_produto.php?codigo_produto=<?php echo $produto['codigo_produto']; ?>" style="color: #3498db; text-decoration: none; margin-right: 10px;">✏️ Editar</a>
                                <a href="/aula_php/CRUD-v1/produtos/excluir_produto.php?codigo_produto=<?php echo $produto['codigo_produto']; ?>" 
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

    <!-- Footer -->
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
