<?php
require_once "../conexao.php";

$mensagem = "";

if (!isset($_GET["codigo_produto"]) && $_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index_produtos.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $codigo_produto        = $_POST["codigo_produto"];
    $titulo         = $_POST["titulo"];
    $valor       = $_POST["valor"];
    $estoque       = $_POST["estoque"];

    if (!empty($senha)) {
        $stmt = $conexao->prepare("UPDATE produtos SET titulo = ?, valor = ?, estoque = ? WHERE codigo_produto = ?");
        $stmt->bind_param("sdii", $titulo, $valor, $estoque, $codigo_produto);
    } else {
        $stmt = $conexao->prepare("UPDATE produtos SET titulo = ?, valor = ?, estoque = ? WHERE codigo_produto = ?");
        $stmt->bind_param("sdii", $titulo, $valor, $estoque, $codigo_produto);
    }

    if ($stmt->execute()) {
        header("Location: index_produtos.php");
        exit;
    } else {
        $mensagem = "Erro ao atualizar: " . $stmt->error;
    }

    $stmt->close();
}

$codigo_produto = $_GET["codigo_produto"];
$stmt   = $conexao->prepare("SELECT * FROM produtos WHERE codigo_produto = ?");
$stmt->bind_param("i", $codigo_produto);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 0) {
    echo "Produto não encontrado.";
    exit;
}

$produto = $resultado->fetch_assoc();
$stmt->close();
$conexao->close();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Produto</title>
</head>
<body>
    <h1>Editar Produto (Código: <?php echo $produto["codigo_produto"]; ?>)</h1>

    <?php if ($mensagem): ?>
        <p><b><?php echo $mensagem; ?></b></p>
    <?php endif; ?>

    <form method="POST" action="editar_produto.php">
        <input type="hidden" name="codigo_produto" value="<?php echo $produto["codigo_produto"]; ?>">

        <label>Nome do Produto:</label><br>
        <input type="text" name="titulo" value="<?php echo htmlspecialchars($produto["titulo"]); ?>" required><br><br>

        <label>Valor:</label><br>
        <input type="number" name="valor" value="<?php echo htmlspecialchars($produto["valor"]); ?>" required><br><br>

        <label>Estoque:</label><br>
        <input type="number" name="estoque"><br><br>

        <br><br>

        <button type="submit">Salvar</button>
    </form>

    <br>
    <a href="index_produtos.php">Voltar para a lista</a>
</body>
</html>
