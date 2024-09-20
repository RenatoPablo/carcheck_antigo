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
    <link rel="stylesheet" href="../css/home-funci.css"> <!-- CSS da Sidebar -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/card-itens.css">
    <link href="../fontawesome/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/popup-not.css">
    <title>Acesso Rápido</title>
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

    <div class="div-inicial">
        <h2>Olá, Malaria Gorda!</h2>
        <p class="div-inicial-p">O que você deseja fazer? Selecione uma das opções:</p>
        
        <div class="container-acesso">
            <!-- Cartões de acesso rápido -->
            <a href="cadastrar-cliente.php">
                <div class="card">
                <img src="../image/iconeCadastrarCliente.png" alt="Cadastrar Cliente" class="img-card">
                    <p class="heading">Cadastrar Cliente</p>
                </div>
            </a>
            <a href="testes.php">
                <div class="card">
                    <img src="../image/carro.png" alt="icone de carro" class="img-card-especifica">
                    <p class="heading">Cadastrar Veículos</p>
                </div>
            </a>
            <a href="">
                <div class="card">
                    <img src="../image/iconeConsultarOrdemServiço.png" alt="Consultar Ordem Serviço" class="img-card">
                    <p class="heading">Consultar Ordem de Serviço</p>
                </div>
            </a>
            <a href="">
                <div class="card">
                    <img src="../image/iconeCadastrarServiço.png" alt="Cadastrar Serviço" class="img-card">
                    <p class="heading">Cadastrar Serviços</p>
                </div>
            </a>
            <a href="">
                <div class="card">
                <img src="../image/iconeGerenciarEstoque.png" alt="Gerenciar Estoque" class="img-card">
                    <p class="heading">Gerenciar Estoque</p>
                </div>
            </a>
            <a href="">
                <div class="card">
                    <img src="../image/iconeEmetirOrdemServiço.png" alt="icone emetir ordem de serviço" class="img-card">
                    <p class="heading">Emitir Ordem de Serviço</p>
                </div>
            </a>
        </div>
    </div>
    

    <script src="../js/script.js"></script>
    <script src="../js/popup-not.js"></script>
</body>
</html>
<?php endif; ?>