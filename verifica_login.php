<?php
// esse arquivo e incluido nas paginas que so podem ser acessadas logado
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}
?>
