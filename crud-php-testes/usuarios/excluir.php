<?php
require_once "conexao.php";

/*
if (!isset($_GET["codigo"])) {
    header("Location: index.php");
    exit;
}
*/

$codigo = $_GET["codigo"];

$stmt = $conexao->prepare("DELETE FROM usuarios WHERE codigo = ?");
$stmt->bind_param("i", $codigo);
$stmt->execute();
$stmt->close();


header("Location: lista_usuarios.php");

