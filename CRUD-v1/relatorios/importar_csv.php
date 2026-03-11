<?php
require_once '../conexao.php';

$mensagem = '';
$erro = false;

//importação CSV de produtos
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_FILES['csv']) && $_FILES['csv']['error'] == 0) {// Verifica se o arquivo foi enviado sem erros
        
        $extensao = pathinfo($_FILES['csv']['name'], PATHINFO_EXTENSION);// Verifica a extensão do arquivo
        if ($extensao != 'csv') {
            $mensagem = "Por favor, envie apenas arquivos CSV.";
            $erro = true;
        } else {
            
            $arquivo = fopen($_FILES['csv']['tmp_name'], 'r');
            $cabecalho = fgetcsv($arquivo);// Pula o cabeçalho
            $contador = 0;
            
            // Prepara a statement SQL
            $sql = "INSERT INTO produtos (titulo, valor, estoque) VALUES (?, ?, ?)";
            $stmt = $conexao->prepare($sql);
            
            if ($stmt) {
                while($linha = fgetcsv($arquivo)) {
                    // Verifica se a linha tem 3 colunas
                    if (count($linha) >= 3) {
                        // Pega os dados da linha
                        $titulo = trim($linha[0]);
                        $preco = str_replace(',', '.', trim($linha[1])); // troca vírgula por ponto
                        $estoque = trim($linha[2]);
                        
                        // Validação
                        if (!empty($titulo) && is_numeric($preco) && is_numeric($estoque)) {
                            
                            $stmt->bind_param("sdi", $titulo, $preco, $estoque);// Bind dos parâmetros e execução
                            if ($stmt->execute()) {
                                $contador++;
                            }
                        }
                    }
                }
                
                $stmt->close();
                $mensagem = "$contador produtos importados com sucesso!";
            } else {
                $mensagem = "Erro ao preparar a consulta: " . $conexao->error;
                $erro = true;
            }
            
            fclose($arquivo);
        }
    } else {
        $mensagem = "Erro ao enviar o arquivo.";
        $erro = true;
    }
}

// Exportação CSV de produtos cadastrados
if (isset($_GET['exportar'])) {

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=produtos.csv');

    $saida = fopen('php://output', 'w');

    fputcsv($saida, ['titulo', 'preco', 'estoque']);// Cabeçalho

    $sql = "SELECT titulo, valor, estoque FROM produtos";
    $resultado = $conexao->query($sql);

    if ($resultado) {
        while ($linha = $resultado->fetch_assoc()) {
            fputcsv($saida, [
                $linha['titulo'],
                $linha['valor'],
                $linha['estoque']
            ]);
        }
    }

    fclose($saida);
    exit;
}
?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Importar Produtos</title>
    <link rel="stylesheet" href="/aula_php/CRUD-v1/style.css">
</head>
<body>
    <header class="header">
        <h1>Sistema de Gerenciamento de Produtos</h1>
        <nav class="nav-menu">
            <a href="/aula_php/CRUD-v1/produtos.php" class="nav-link active">📋 Listar Produtos</a>
            <a href="/aula_php/CRUD-v1/usuarios.php" class="nav-link">📋 Listar Usuários</a>
            <a href="/aula_php/CRUD-v1/relatorios/importar_csv.php" class="nav-link">📊 Relatórios (prox passos)</a>
        </nav>
    </header>

    <main class="main-container">
        <div class="content-area">
            <div class="content-header">
                <h3>Importar Produtos (CSV)</h3>
            </div>

            <?php if ($mensagem): ?>
                <div class="alert alert-<?= $erro ? 'danger' : 'success' ?>">
                    <?= htmlspecialchars($mensagem) ?>
                </div>
            <?php endif; ?>

            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="form-label" for="csv">Arquivo CSV:</label>
                    <input type="file" name="csv" id="csv" class="form-control" accept=".csv" required>
                </div>

                <div class="alert-info">
                    <strong>Formato do CSV:</strong><br>
                    nome,preco,estoque<br>
                    <small>Ex: Notebook,4500.00,15</small>
                </div>

                <button type="submit" class="btn-primary">
                    Importar
                </button>
            </form>

            <hr>
            
            <div class="content-header">
                <h3>Exportar Produtos (CSV)</h3>
            </div>
                <div class="alert-info">
                    Clique no botão abaixo para baixar todos os produtos cadastrados em formato CSV.
                </div>

                <a href="importar_csv.php?exportar=1" class="btn-primary">
                    Exportar Produtos CSV
                </a>
            <hr>
            <a href="/aula_php/CRUD-v1/produtos.php" class="btn-outline-secondary">
                Ver produtos cadastrados
            </a>
        </div>
    </main>
</body>
</html>