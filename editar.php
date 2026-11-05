<?php
include("verifica_login.php");
include("conexao.php");

$usuario_id = $_SESSION['usuario_id'];
$erro = "";

// pega o id da peca pela URL ou pelo formulario
if (isset($_POST['id'])) {
    $id = $_POST['id'];
} else if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header("Location: listar.php");
    exit;
}

// quando clicar em salvar
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nome_peca = trim($_POST['nome_peca']);
    $categoria = $_POST['categoria'];
    $cor = trim($_POST['cor']);
    $estacao = $_POST['estacao'];
    $ocasiao = $_POST['ocasiao'];

    if ($nome_peca == "" || $categoria == "") {
        $erro = "Nome da peça e categoria são obrigatórios!";
    } else {
        // o usuario_id no WHERE garante que ninguem altera a peca de outra pessoa
        $sql = "UPDATE peca_roupa SET nome_peca = ?, categoria = ?, cor = ?, estacao = ?, ocasiao = ?
                WHERE id = ? AND usuario_id = ?";
        $stmt = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($stmt, "sssssii", $nome_peca, $categoria, $cor, $estacao, $ocasiao, $id, $usuario_id);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: listar.php?msg=editado");
            exit;
        } else {
            $erro = "Erro ao alterar a peça.";
        }
    }
}

// busca os dados atuais da peca para preencher o formulario
$sql = "SELECT * FROM peca_roupa WHERE id = ? AND usuario_id = ?";
$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, "ii", $id, $usuario_id);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);
$peca = mysqli_fetch_assoc($resultado);

if (!$peca) {
    // nao achou ou a peca nao e dessa usuaria
    header("Location: listar.php");
    exit;
}

$categorias = array("Blusa", "Calça", "Saia", "Vestido", "Casaco", "Calçado", "Acessório");
$estacoes = array("Todas", "Verão", "Outono", "Inverno", "Primavera");
$ocasioes = array("Casual", "Trabalho", "Festa", "Academia");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar peça - Closet Virtual</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <?php include("menu.php"); ?>

    <div class="conteudo">
        <h2>Editar peça</h2>

        <?php if ($erro != "") { ?>
            <div class="msg-erro"><?php echo $erro; ?></div>
        <?php } ?>

        <form method="POST" action="editar.php" class="formulario">
            <input type="hidden" name="id" value="<?php echo $peca['id']; ?>">

            <label>Nome da peça *</label>
            <input type="text" name="nome_peca" value="<?php echo htmlspecialchars($peca['nome_peca']); ?>" required>

            <label>Categoria *</label>
            <select name="categoria" required>
                <?php foreach ($categorias as $cat) { ?>
                    <option value="<?php echo $cat; ?>" <?php if ($peca['categoria'] == $cat) echo "selected"; ?>><?php echo $cat; ?></option>
                <?php } ?>
            </select>

            <label>Cor</label>
            <input type="text" name="cor" value="<?php echo htmlspecialchars($peca['cor']); ?>">

            <label>Estação</label>
            <select name="estacao">
                <?php foreach ($estacoes as $est) { ?>
                    <option value="<?php echo $est; ?>" <?php if ($peca['estacao'] == $est) echo "selected"; ?>><?php echo $est; ?></option>
                <?php } ?>
            </select>

            <label>Ocasião</label>
            <select name="ocasiao">
                <?php foreach ($ocasioes as $oc) { ?>
                    <option value="<?php echo $oc; ?>" <?php if ($peca['ocasiao'] == $oc) echo "selected"; ?>><?php echo $oc; ?></option>
                <?php } ?>
            </select>

            <button type="submit">Salvar alterações</button>
            <a href="listar.php" class="link-voltar">Cancelar</a>
        </form>
    </div>
</body>
</html>
