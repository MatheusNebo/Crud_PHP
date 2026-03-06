<?php
require_once __DIR__ . "/../conexao.php";

/*
if (!isset($_GET["codigo"])) {
    header("Location: index.php");
    exit;
}
*/

$codigo = $_GET["codigo"];

/** LINGUAGEM SQL
 * CREATE - CRIAR TABELA
 * SELECT - SELECIONAR DADOS
 * UPDATE - ATUALIZAR DADOS
 * DELETE - DELETAR DADOS
 * INSERT - INSERIR DADOS
 */

$sqlDelete = $conexao->prepare("DELETE FROM usuarios WHERE codigo = ?");
$stmt->bind_param("i", $codigo);
$stmt->execute();
$stmt->close();

$conexao->close();

header("Location: index.php");

