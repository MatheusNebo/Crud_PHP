<?php
require_once __DIR__ . "/../conexao.php";


if (!isset($_GET["codigo"]) && $_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit;
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $codigo        = $_POST["codigo"];
    $nome          = $_POST["nome"];
    $email         = $_POST["email"];
    $senha         = $_POST["senha"];
    $administrador = isset($_POST["administrador"]) ? 1 : 0;

    if (!empty($senha)) {
        $stmt = $conexao->prepare("UPDATE usuarios SET nome = ?, email = ?, senha = ?, administrador = ? WHERE codigo = ?");
        $stmt->bind_param("sssii", $nome, $email, $senha, $administrador, $codigo);
    } else {
        $stmt = $conexao->prepare("UPDATE usuarios SET nome = ?, email = ?, administrador = ? WHERE codigo = ?");
        $stmt->bind_param("ssii", $nome, $email, $administrador, $codigo);
    }

    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    } 
    $stmt->close();
}

$codigo = $_GET["codigo"];
$stmt   = $conexao->prepare("SELECT * FROM usuarios WHERE codigo = ?");
$stmt->bind_param("i", $codigo);
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
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuário</title>
</head>
<body>
    <h1>Editar Usuário (Código: <?php echo $usuario["codigo"]; ?>)</h1>

    <form method="POST" action="editar.php">
        <input type="hidden" name="codigo" value="<?php echo $usuario["codigo"]; ?>">

        <label>Nome:</label><br>
        <input type="text" name="nome" value="<?php echo htmlspecialchars($usuario["nome"]); ?>" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" value="<?php echo htmlspecialchars($usuario["email"]); ?>" required><br><br>

        <label>Senha (deixe em branco para manter a atual):</label><br>
        <input type="password" name="senha"><br><br>

        <label>
            <input type="checkbox" name="administrador" value="1"
                <?php echo $usuario["administrador"] ? "checked" : ""; ?>>
            Administrador
        </label><br><br>

        <button type="submit">Salvar</button>
    </form>

    <br>
    <a href="index.php">Voltar para a lista</a>
</body>
</html>
