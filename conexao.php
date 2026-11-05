<?php
// arquivo de conexao com o banco de dados
// no XAMPP o padrao e root sem senha

$servidor = "localhost";
$usuario_bd = "root";
$senha_bd = "";
$banco = "closet_virtual";

$conexao = mysqli_connect($servidor, $usuario_bd, $senha_bd, $banco);

if (!$conexao) {
    die("Erro ao conectar com o banco: " . mysqli_connect_error());
}

mysqli_set_charset($conexao, "utf8");
?>
