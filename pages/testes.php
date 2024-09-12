<?php
    session_start();
    // print_r($_SESSION);
    if(!isset($_SESSION) OR $_SESSION['logado'] != true):
		header("location: ../config/sair.php");		
	else:
?>
<!DOCTYPE html>
<html lang="pt-bt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testes</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .form-teste{
            position: relative;
            top: 200px;
        }
    </style>
</head>
<body>
<header>
        <!-- Sidebar -->
        <div class="sidebar">
            <a href="#home">Home</a>
            <a href="#services">Services</a>
            <a href="#clients">Clients</a>
            <a href="../config/sair.php">Sair</a>
        </div>
    
        <div class="container-header">
            <img src="../image/logo-carcheck.png" alt="Logo CarCheck" title="CarCheck">
            <h1>CarCheck</h1>
        </div>
    
        <div class="icons">
            <!-- Botão para mostrar a notificação -->
            <button onclick="showNotification()" class="icons-not">
            <i class="fa-solid fa-bell fa-2xl" style="color: #ffffff;"></i></button>

            <!-- Popup de notificação -->
            <div id="notification" class="notification">
                <span id="notification-text">Este é um alerta de notificação!</span>
                <span class="close-btn" onclick="closeNotification()">&times;</span>
            </div>

            <!-- <a href="pages/notificacao.html"><i class="fa-solid fa-bell fa-2xl" style="color: #ffffff;"></i></a> -->

            <a href="pages/home.html"><i class="fa-solid fa-house-chimney fa-2xl casa" style="color: #ffffff;"></i></a>
            <a href="pages/perfil.html"><i class="fa-solid fa-user fa-2xl" style="color: #ffffff;"></i></a>
        </div>
        
        <!-- botao hamburguer side bar -->
        <input type="checkbox" id="checkbox" onclick="toggleSidebar()">
        <label for="checkbox" class="toggle">
            <div class="bar bar--top"></div>
            <div class="bar bar--middle"></div>
            <div class="bar bar--bottom"></div>
        </label>

        <!-- Botão para abrir a sidebar -->
        <!-- <button class="open-btn" onclick="toggleSidebar()">☰</button> -->
    </header>

    <form action="../config/logica_teste.php" method="post" class="form-teste">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome">

        <label for="telefone">Telefone:</label>
        <input type="tel" name="telefone" id="telefone">

        <label for="email">Email:</label>
        <input type="email" name="email" id="email">

        <label for="senha">Senha</label>
        <input type="password" name="senha" id="senha">

        <label for="estado">Estado:</label>
        <input id="estado" name="estado" type="text">

        <button type="submit">Enviar</button>
    </form>
</body>
</html>

<?php endif; ?>