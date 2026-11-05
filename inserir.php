<?php
include("verifica_login.php");
include("conexao.php");

$erro = "";
$sucesso = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nome_peca = trim($_POST['nome_peca']);
    $categoria = $_POST['categoria'];
    $cor = trim($_POST['cor']);
    $estacao = $_POST['estacao'];
    $ocasiao = $_POST['ocasiao'];
    $usuario_id = $_SESSION['usuario_id']; // a peca fica ligada a usuaria logada

    if ($nome_peca == "" || $categoria == "") {
        $erro = "Nome da peça e categoria são obrigatórios!";
    } else {
        $sql = "INSERT INTO peca_roupa (usuario_id, nome_peca, categoria, cor, estacao, ocasiao)
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($stmt, "isssss", $usuario_id, $nome_peca, $categoria, $cor, $estacao, $ocasiao);

        if (mysqli_stmt_execute($stmt)) {
            $sucesso = "Peça cadastrada com sucesso!";
        } else {
            $erro = "Erro ao cadastrar a peça.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova peça - Closet Virtual</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <?php include("menu.php"); ?>

    <div class="conteudo">
        <h2>Cadastrar nova peça</h2>

        <?php if ($erro != "") { ?>
            <div class="msg-erro"><?php echo $erro; ?></div>
        <?php } ?>
        <?php if ($sucesso != "") { ?>
            <div class="msg-sucesso"><?php echo $sucesso; ?></div>
        <?php } ?>

        <form method="POST" action="inserir.php" class="formulario">
            <label>Nome da peça *</label>
            <input type="text" name="nome_peca" placeholder="Ex: Blusa de alcinha" required>

            <label>Categoria *</label>
            <select name="categoria" required>
                <option value="">Selecione</option>
                <option value="Blusa">Blusa</option>
                <option value="Calça">Calça</option>
                <option value="Saia">Saia</option>
                <option value="Vestido">Vestido</option>
                <option value="Casaco">Casaco</option>
                <option value="Calçado">Calçado</option>
                <option value="Acessório">Acessório</option>
            </select>

            <label>Cor</label>
            <input type="text" name="cor" placeholder="Ex: Rosa">

            <label>Estação</label>
            <select name="estacao">
                <option value="Todas">Todas</option>
                <option value="Verão">Verão</option>
                <option value="Outono">Outono</option>
                <option value="Inverno">Inverno</option>
                <option value="Primavera">Primavera</option>
            </select>

            <label>Ocasião</label>
            <select name="ocasiao">
                <option value="Casual">Casual</option>
                <option value="Trabalho">Trabalho</option>
                <option value="Festa">Festa</option>
                <option value="Academia">Academia</option>
            </select>

            <button type="submit">Salvar</button>
        </form>
    </div>
</body>
</html>
