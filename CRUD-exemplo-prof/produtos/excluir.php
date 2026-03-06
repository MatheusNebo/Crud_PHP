<?php
require_once "../conexao.php";

if (!isset($_GET["codigo"])) {
    header("Location: index.php");
    exit;
}

$codigo = $_GET["codigo"];

$stmt = $conexao->prepare("DELETE FROM produtos WHERE codigo = ?");
$stmt->bind_param("i", $codigo);
$stmt->execute();
$stmt->close();

$conexao->close();

header("Location: index.php");
