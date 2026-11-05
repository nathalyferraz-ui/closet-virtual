<?php
include("verifica_login.php");
include("conexao.php");

$usuario_id = $_SESSION['usuario_id'];

// filtro por categoria (opcional)
$filtro = "";
if (isset($_GET['categoria'])) {
    $filtro = $_GET['categoria'];
}

// mostra so as pecas da usuaria que esta logada
if ($filtro != "") {
    $sql = "SELECT * FROM peca_roupa WHERE usuario_id = ? AND categoria = ? ORDER BY nome_peca";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "is", $usuario_id, $filtro);
} else {
    $sql = "SELECT * FROM peca_roupa WHERE usuario_id = ? ORDER BY nome_peca";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "i", $usuario_id);
}

mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);

$categorias = array("Blusa", "Calça", "Saia", "Vestido", "Casaco", "Calçado", "Acessório");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu closet - Closet Virtual</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <?php include("menu.php"); ?>

    <div class="conteudo">
        <h2>Meu closet</h2>

        <?php if (isset($_GET['msg']) && $_GET['msg'] == "editado") { ?>
            <div class="msg-sucesso">Peça alterada com sucesso!</div>
        <?php } ?>

        <form method="GET" action="listar.php" class="filtro">
            <label>Filtrar por categoria:</label>
            <select name="categoria">
                <option value="">Todas</option>
                <?php foreach ($categorias as $cat) { ?>
                    <option value="<?php echo $cat; ?>" <?php if ($filtro == $cat) echo "selected"; ?>>
                        <?php echo $cat; ?>
                    </option>
                <?php } ?>
            </select>
            <button type="submit">Filtrar</button>
        </form>

        <?php if (mysqli_num_rows($resultado) == 0) { ?>
            <p>Nenhuma peça encontrada. <a href="inserir.php">Cadastre a primeira!</a></p>
        <?php } else { ?>
            <table>
                <tr>
                    <th>Peça</th>
                    <th>Categoria</th>
                    <th>Cor</th>
                    <th>Estação</th>
                    <th>Ocasião</th>
                    <th>Ações</th>
                </tr>
                <?php while ($peca = mysqli_fetch_assoc($resultado)) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($peca['nome_peca']); ?></td>
                        <td><?php echo htmlspecialchars($peca['categoria']); ?></td>
                        <td><?php echo htmlspecialchars($peca['cor']); ?></td>
                        <td><?php echo htmlspecialchars($peca['estacao']); ?></td>
                        <td><?php echo htmlspecialchars($peca['ocasiao']); ?></td>
                        <td><a class="botao-editar" href="editar.php?id=<?php echo $peca['id']; ?>">Editar</a></td>
                    </tr>
                <?php } ?>
            </table>
        <?php } ?>
    </div>
</body>
</html>
