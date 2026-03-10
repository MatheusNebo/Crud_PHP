<?php
require_once __DIR__ . "/../conexao.php";
require_once __DIR__ . "/../relatorios/consultas.php";

$vendas_mes = getVendasDoMes($conexao);
$produtos_top = getProdutosMaisVendidos($conexao);
$vendedores = getResumoVendedores($conexao);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/aula_php/CRUD-v1/style.css">
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

    <main class="main-container">
        <div class="content-area">
            <div class="content-header">
                <h2>Relatório de Vendas</h2>
            </div>
                    <h3>Vendas do Mês: R$ <?= $vendas_mes['valor'] ?></h3>
                <table>
                    <thead>
                        <tr style="background-color: #f8f9fa; border-bottom: 2px solid #dee2e6;">
                            <th style="padding: 12px; text-align: left;">Título</th>
                            <th style="padding: 12px; text-align: left;">Qtde.</th>
                        </tr>
                    </thead>
                    <?php while($p = $produtos_top->fetch_assoc()): ?>
                        
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 12px;"><?= $p['titulo'] ?></td>
                        <td style="padding: 12px;"><?= $p['total'] ?> unidades</td>
                    </tr>
    
                    <?php endwhile; ?>
                </table>
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