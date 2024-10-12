<?php
    session_start();
    // print_r($_SESSION);
    if(!isset($_SESSION) OR $_SESSION['logado'] != true):
		header("location: ../config/sair.php");		
	else:
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../fontawesome/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/popup-not.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Cadastro de Fornecedor</title>
    <style>
        .campos-forncedor{
            position: relative;
            top: 150px;
        }
    </style>
</head>
<body>
    <header>

        <!-- Sidebar -->
        <div class="sidebar">
            <a href="../pages/home-cliente.php">Home</a>
            <a href="../pages/cadastrar-funci.php">Cadastrar Funcionário</a>
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

            <a href="../pages/home-funci.php"><i class="fa-solid fa-house-chimney fa-2xl casa" style="color: #ffffff;"></i></a>
            <a href="../pages/perfil.php"><i class="fa-solid fa-user fa-2xl" style="color: #ffffff;"></i></a>
        </div>
        <input type="checkbox" id="checkbox" onclick="toggleSidebar()">
        <label for="checkbox" class="toggle">
            <div class="bar bar--top"></div>
            <div class="bar bar--middle"></div>
            <div class="bar bar--bottom"></div>
        </label>
    </header>

        <form action="../config/processa-cadastro-fornecedor.php" method="POST">
            <div class="campos-forncedor">
                <div class="input-container">
                    <label for="nome_fantasia">Nome da empresa</label>
                    <input type="text" name="nome_fantasia" id="nome_fantasia" class="input">
                </div>
                <div class="input-container">
                    <label for="razao_social">Razão social</label>
                    <input type="text" name="razao_social" id="razao_social" class="input">
                </div>
                <div class="input-container">
                    <label for="ie">IE</label>
                    <input type="text" name="ie" id="ie" class="input">
                </div>
                <div class="input-container">
                    <label for="cnpj">CNPJ</label>
                    <input type="text" name="cnpj" id="cnpj" class="input">
                </div>
                <button type="submit">Enviar</button>
            </div>
        </form>

</body>
</html>
<?php endif; ?>