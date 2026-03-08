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

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $maxFileSize = 20 * 1024 * 1024; // 20MB em bytes
    
    if (isset($_FILES["imagem"]) && $_FILES["imagem"]["error"] === UPLOAD_ERR_OK) {
        if ($_FILES["imagem"]["size"] > $maxFileSize) {
            die("Erro: A imagem excede o limite de 20MB");
        }
        
        // validar tipo de arquivo
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        if (!in_array($_FILES["imagem"]["type"], $allowedTypes)) {
            die("Erro: Tipo de arquivo não permitido. Use apenas imagens (JPEG, PNG, GIF, WEBP)");
        }
        
        $imagem = file_get_contents($_FILES["imagem"]["tmp_name"]);
        $imagem_tipo = $_FILES["imagem"]["type"];
    }
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
