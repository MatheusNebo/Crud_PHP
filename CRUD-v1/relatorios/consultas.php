<?php
require_once __DIR__ . "/../conexao.php";

function getVendasDoMes($conexao) {
    $sql = "SELECT COUNT(*) as total, SUM(valor_total) as valor  -- total de vendas e valor total do mês
            FROM vendas 
            WHERE MONTH(data_venda) = MONTH(CURDATE()) -- filtra pelo mês e ano atuais
            AND YEAR(data_venda) = YEAR(CURDATE())";
    return $conexao->query($sql)->fetch_assoc(); 
}

function getProdutosMaisVendidos($conexao, $limite = 5) {
    $sql = "SELECT p.titulo, SUM(vi.quantidade) as total -- seleciona o título do produto e a quantidade total vendida
            FROM produtos p
            LEFT JOIN venda_itens vi ON p.codigo_produto = vi.codigo_produto -- junta com os itens de venda
            LEFT JOIN vendas v ON vi.codigo_venda = v.codigo_venda -- junta com as venda para filtrar por status
            WHERE v.status = 'concluida' OR v.status IS NULL -- considera apenas vendas concluídas e produtos sem vendas
            GROUP BY p.codigo_produto
            ORDER BY total DESC
            LIMIT $limite";
    return $conexao->query($sql);
}

function getVendasPorPeriodo($conexao, $data_inicio, $data_fim) {
    $sql = "SELECT v.*, c.nome as cliente_nome, u.nome as vendedor_nome -- seleciona as vendas com os nomes do cliente e vendedor
            FROM vendas v
            INNER JOIN clientes c ON v.codigo_cliente = c.codigo_cliente -- junta com os clientes para obter o nome
            INNER JOIN usuarios u ON v.codigo_usuario = u.codigo_usuario -- junta com os usuários para obter o nome
            WHERE DATE(v.data_venda) BETWEEN '$data_inicio' AND '$data_fim' -- filtra por período
            ORDER BY v.data_venda DESC";
    return $conexao->query($sql);
}

function getDetalhesVenda($conexao, $codigo_venda) {
    $sql = "SELECT vi.*, p.titulo -- seleciona os itens da venda com o título do produto
            FROM venda_itens vi
            INNER JOIN produtos p ON vi.codigo_produto = p.codigo_produto -- junta com os produtos para obter o título
            WHERE vi.codigo_venda = $codigo_venda"; 
    return $conexao->query($sql);
}

function getResumoVendedores($conexao) {
    $sql = "SELECT 
                u.nome,
                COUNT(v.codigo_venda) as total_vendas,
                SUM(v.valor_total) as valor_total
            FROM usuarios u
            LEFT JOIN vendas v ON u.codigo_usuario = v.codigo_usuario
            GROUP BY u.codigo_usuario
            ORDER BY valor_total DESC";
    return $conexao->query($sql);
}
?>