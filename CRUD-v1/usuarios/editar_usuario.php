<?php
require_once "../conexao.php";

$mensagem = "";

if (!isset($_GET["codigo_usuario"]) && $_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: /aula_php/CRUD-v1/usuarios.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $codigo_usuario        = $_POST["codigo_usuario"];
    $nome          = $_POST["nome"];
    $email         = $_POST["email"];
    $senha         = $_POST["senha"];
    $administrador = isset($_POST["administrador"]) ? 1 : 0;

    if (!empty($senha)) {
        $stmt = $conexao->prepare("UPDATE usuarios SET nome = ?, email = ?, senha = ?, administrador = ? WHERE codigo_usuario = ?");
        $stmt->bind_param("sssii", $nome, $email, $senha, $administrador, $codigo_usuario);
    } else {
        $stmt = $conexao->prepare("UPDATE usuarios SET nome = ?, email = ?, administrador = ? WHERE codigo_usuario = ?");
        $stmt->bind_param("ssii", $nome, $email, $administrador, $codigo_usuario);
    }

    if ($stmt->execute()) {
        header("Location: /aula_php/CRUD-v1/usuarios.php");
        exit;
    } else {
        $mensagem = "Erro ao atualizar: " . $stmt->error;
    }

    $stmt->close();
}

$codigo_usuario = $_GET["codigo_usuario"];
$stmt   = $conexao->prepare("SELECT * FROM usuarios WHERE codigo_usuario = ?");
$stmt->bind_param("i", $codigo_usuario);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 0) {
    echo "Usuário não encontrado.";
    exit;
}

$usuario = $resultado->fetch_assoc();
$stmt->close();
$conexao->close();
?>

<?php require "form_edita_usuario.php"; ?>
