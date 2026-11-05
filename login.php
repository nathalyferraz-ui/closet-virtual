<?php
session_start();
include("conexao.php");

$erro = "";

// se ja estiver logada vai direto pro closet
if (isset($_SESSION['usuario_id'])) {
    header("Location: listar.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // busca o usuario pelo email
    $sql = "SELECT id, nome, senha FROM usuario WHERE email = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $usuario = mysqli_fetch_assoc($resultado);

    // confere se achou o usuario e se a senha bate com o hash salvo
    if ($usuario && password_verify($senha, $usuario['senha'])) {
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['nome'];
        header("Location: listar.php");
        exit;
    } else {
        $erro = "Email ou senha incorretos!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Closet Virtual</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <div class="caixa-login">
        <h1>Closet Virtual</h1>
        <p>Organize suas roupas e monte seus looks</p>

        <?php if ($erro != "") { ?>
            <div class="msg-erro"><?php echo $erro; ?></div>
        <?php } ?>

        <form method="POST" action="login.php">
            <label>Email</label>
            <input type="email" name="email" required>

            <label>Senha</label>
            <input type="password" name="senha" required>

            <button type="submit">Entrar</button>
        </form>

        <p class="link-menor">Não tem conta? <a href="cadastro.php">Cadastre-se</a></p>
    </div>
</body>
</html>
