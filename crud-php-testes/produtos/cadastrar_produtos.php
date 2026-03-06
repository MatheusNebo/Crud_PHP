<?php
require_once "conexao.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $titulo          = $_POST["titulo"];
    $valor         = $_POST["valor"];
    $estoque         = $_POST["estoque"];

    $stmt = $conexao->prepare("INSERT INTO produtos (codigo, titulo, valor, estoque) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isdi", $codigo, $titulo, $valor, $estoque);
    $stmt->execute();
    $stmt->close();

    header("Location: index.php");
    exit;
}

$conexao->close();

require "form_cadastra.php";
