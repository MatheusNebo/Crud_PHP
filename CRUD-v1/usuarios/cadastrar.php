<?php
require_once "../conexao.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome          = $_POST["nome"];
    $email         = $_POST["email"];
    $senha         = $_POST["senha"];
    $administrador = isset($_POST["administrador"]) ? 1 : 0;

    $stmt = $conexao->prepare("INSERT INTO usuarios (nome, email, senha, administrador) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $nome, $email, $senha, $administrador);
    $stmt->execute();
    $stmt->close();

    header("Location: /aula_php/CRUD-v1/usuarios.php");
    exit;
}

$conexao->close();

require "form_cadastra_usuario.php";
