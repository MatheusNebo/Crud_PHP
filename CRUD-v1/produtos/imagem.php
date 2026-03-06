<?php
require_once __DIR__ . "/../conexao.php";

if (!isset($_GET["codigo_produto"])) {
    http_response_code(400);
    exit;
}

$codigo_produto = $_GET["codigo_produto"];

$stmt = $conexao->prepare("SELECT imagem, imagem_tipo FROM produtos WHERE codigo_produto = ?");
$stmt->bind_param("i", $codigo_produto);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 0) {
    http_response_code(404);
    exit;
}

$stmt->bind_result($imagem, $imagem_tipo);
$stmt->fetch();

if (empty($imagem)) {
    http_response_code(404);
    exit;
}

header("Content-Type: " . $imagem_tipo);
echo $imagem;

$stmt->close();
$conexao->close();
