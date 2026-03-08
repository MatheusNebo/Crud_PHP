<?php
require_once __DIR__ . "/../conexao.php";

/*
if (!isset($_GET["codigo"])) {
    header("Location: index.php");
    exit;
}
*/

$codigo_produto = $_GET["codigo_produto"];

$stmt = $conexao->prepare("DELETE FROM produtos WHERE codigo_produto = ?");
$stmt->bind_param("i", $codigo_produto);
$stmt->execute();
$stmt->close();

$conexao->close();

header("Location: produtos.php");

