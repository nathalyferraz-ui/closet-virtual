<!-- menu que aparece no topo das paginas internas -->
<div class="topo">
    <span class="logo">Closet Virtual</span>
    <nav>
        <a href="listar.php">Meu closet</a>
        <a href="inserir.php">Nova peça</a>
        <a href="logout.php">Sair</a>
    </nav>
</div>
<p class="ola">Olá, <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?>!</p>
