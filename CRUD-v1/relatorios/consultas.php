<?php
require_once __DIR__ . "/../conexao.php";

function getVendasDoMes($conexao) {
    $sql = "SELECT COUNT(*) as total, SUM(valor_total) as valor  -- total de vendas e valor total do mês
            FROM vendas 
            WHERE MONTH(data_venda) = MONTH(CURDATE()) -- filtra pelo mês e ano atuais
            AND YEAR(data_venda) = YEAR(CURDATE())";
    
    $resultado = $conexao->query($sql);
    return $resultado->fetch_assoc(); 
}

function getProdutosMaisVendidos($conexao, $limite = 5) {
    $sql = "SELECT p.titulo, SUM(vi.quantidade) as total -- seleciona o título do produto e a quantidade total vendida
            FROM produtos p
            LEFT JOIN venda_itens vi ON p.codigo_produto = vi.codigo_produto -- junta com os itens de venda
            LEFT JOIN vendas v ON vi.codigo_venda = v.codigo_venda -- junta com as venda para filtrar por status
            WHERE v.status = 'concluida' OR v.status IS NULL -- considera apenas vendas concluídas e produtos sem vendas
            GROUP BY p.codigo_produto
            ORDER BY total DESC
            LIMIT ?";  // ? no lugar de $limite para prepared statement
    
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $limite);
    $stmt->execute();
    return $stmt->get_result();
}

function getVendasPorPeriodo($conexao, $data_inicio, $data_fim) {
    $sql = "SELECT v.*, c.nome as cliente_nome, u.nome as vendedor_nome -- seleciona as vendas com os nomes do cliente e vendedor
            FROM vendas v
            INNER JOIN clientes c ON v.codigo_cliente = c.codigo_cliente -- junta com os clientes para obter o nome
            INNER JOIN usuarios u ON v.codigo_usuario = u.codigo_usuario -- junta com os usuários para obter o nome
            WHERE DATE(v.data_venda) BETWEEN ? AND ? -- ? no lugar de '$data_inicio' AND '$data_fim'
            ORDER BY v.data_venda DESC";
    
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ss", $data_inicio, $data_fim);
    $stmt->execute();
    return $stmt->get_result();
}

function getDetalhesVenda($conexao, $codigo_venda) {
    $sql = "SELECT vi.*, p.titulo -- seleciona os itens da venda com o título do produto
            FROM venda_itens vi
            INNER JOIN produtos p ON vi.codigo_produto = p.codigo_produto -- junta com os produtos para obter o título
            WHERE vi.codigo_venda = ?";  // ? no lugar de $codigo_venda para prepared statement
    
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $codigo_venda);
    $stmt->execute();
    return $stmt->get_result();
}

function getResumoVendedores($conexao) {
    $sql = "SELECT 
                u.nome,
                COUNT(v.codigo_venda) as total_vendas, -- conta o número de vendas por usuario(vendedor)
                SUM(v.valor_total) as valor_total -- soma o valor total das vendas
            FROM usuarios u
            LEFT JOIN vendas v ON u.codigo_usuario = v.codigo_usuario -- junta com as vendas para obter os dados
            GROUP BY u.codigo_usuario -- agrupa por usuario(vendedor) e ordena o valor total em ordem decrescente
            ORDER BY valor_total DESC";    
    $resultado = $conexao->query($sql);
    return $resultado;
}
?>