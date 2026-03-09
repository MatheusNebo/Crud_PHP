<?php
require_once __DIR__ . "/../conexao.php";

if (!isset($_GET["codigo_produto"]) && $_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: /aula_php/CRUD-v1/produtos.php"); 
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $codigo_produto  = $_POST["codigo_produto"];
    $titulo          = $_POST["titulo"] ;
    $valor           = $_POST["valor"];
    $estoque         = $_POST["estoque"];

    $remover_imagem = isset($_POST["remover_imagem"]) && $_POST["remover_imagem"] === "1";

    if ($remover_imagem) {
        $stmt = $conexao->prepare("UPDATE produtos SET titulo = ?, valor = ?, estoque = ?, imagem = NULL, imagem_tipo = NULL WHERE codigo_produto = ?");
        $stmt->bind_param("sdii", $titulo, $valor, $estoque, $codigo_produto);
    } elseif (isset($_FILES["imagem"]) && $_FILES["imagem"]["error"] === UPLOAD_ERR_OK) {
        $imagem = file_get_contents($_FILES["imagem"]["tmp_name"]);
        $imagem_tipo = $_FILES["imagem"]["type"];

        $stmt = $conexao->prepare("UPDATE produtos SET titulo = ?, valor = ?, estoque = ?, imagem = ?, imagem_tipo = ? WHERE codigo_produto = ?");
        $stmt->bind_param("sdissi", $titulo, $valor, $estoque, $imagem, $imagem_tipo, $codigo_produto);
        $stmt->send_long_data(3, $imagem);
    } else {
        $stmt = $conexao->prepare("UPDATE produtos SET titulo = ?, valor = ?, estoque = ? WHERE codigo_produto = ?");
        $stmt->bind_param("sdii", $titulo, $valor, $estoque, $codigo_produto);
    }

    if ($stmt->execute()) {
        header("Location: /aula_php/CRUD-v1/produtos.php");
        exit;
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

<?php require "form_edita_produto.php"; ?>