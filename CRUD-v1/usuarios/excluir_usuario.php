<?php
require_once "../conexao.php";

/*
if (!isset($_GET["codigo"])) {
    header("Location: index.php");
    exit;
}
*/

$codigo_usuario = $_GET["codigo_usuario"];

$stmt = $conexao->prepare("DELETE FROM usuarios WHERE codigo_usuario = ?");
$stmt->bind_param("i", $codigo_usuario);
$stmt->execute();
$stmt->close();

$conexao->close();

header("Location: /aula_php/CRUD-v1/usuarios.php");

