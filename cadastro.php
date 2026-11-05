<?php
// cadastro de novo usuario
include("conexao.php");

$erro = "";
$sucesso = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];

    if ($nome == "" || $email == "" || $senha == "") {
        $erro = "Preencha todos os campos!";
    } else {
        // verifica se o email ja existe
        $sql = "SELECT id FROM usuario WHERE email = ?";
        $stmt = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($resultado) > 0) {
            $erro = "Esse email já está cadastrado.";
        } else {
            // a senha e salva criptografada
            $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

            $sql = "INSERT INTO usuario (nome, email, senha) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($conexao, $sql);
            mysqli_stmt_bind_param($stmt, "sss", $nome, $email, $senha_hash);

            if (mysqli_stmt_execute($stmt)) {
                $sucesso = "Cadastro feito! Agora é só fazer o login.";
            } else {
                $erro = "Erro ao cadastrar.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Closet Virtual</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <div class="caixa-login">
        <h1>Criar conta</h1>

        <?php if ($erro != "") { ?>
            <div class="msg-erro"><?php echo $erro; ?></div>
        <?php } ?>
        <?php if ($sucesso != "") { ?>
            <div class="msg-sucesso"><?php echo $sucesso; ?></div>
        <?php } ?>

        <form method="POST" action="cadastro.php">
            <label>Nome</label>
            <input type="text" name="nome" required>

            <label>Email</label>
            <input type="email" name="email" required>

            <label>Senha</label>
            <input type="password" name="senha" required>

            <button type="submit">Cadastrar</button>
        </form>

        <p class="link-menor"><a href="login.php">Voltar para o login</a></p>
    </div>
</body>
</html>
