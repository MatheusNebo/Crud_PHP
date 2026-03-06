<?php
require_once "../conexao.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $titulo  = $_POST["titulo"];
    $valor   = $_POST["valor"];
    $estoque = $_POST["estoque"];
    $imagem = null;
    $imagem_tipo = null;

    if (isset($_FILES["imagem"]) && $_FILES["imagem"]["error"] === UPLOAD_ERR_OK) {
        $imagem = file_get_contents($_FILES["imagem"]["tmp_name"]);
        $imagem_tipo = $_FILES["imagem"]["type"];
    }

    $stmt = $conexao->prepare("INSERT INTO produtos (titulo, valor, estoque, imagem, imagem_tipo) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sdiss", $titulo, $valor, $estoque, $imagem, $imagem_tipo);
    $stmt->send_long_data(3, $imagem);
    $stmt->execute();
    $stmt->close();

    header("Location: index_produtos.php");
    exit;
}

$conexao->close();

require "form_cadastra_produto.html";
