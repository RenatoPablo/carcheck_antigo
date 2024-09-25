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
    <title>Cadastrar Veículo</title>
    <link rel="stylesheet" href="../css/style.css">
    <link href="../fontawesome/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/popup-not.css">
    <link rel="stylesheet" href="../css/cadastrar-veiculo.css">
    <style>
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
            <a href="perfil.php"><i class="fa-solid fa-user fa-2xl" style="color: #ffffff;"></i></a>
        </div>
        <input type="checkbox" id="checkbox" onclick="toggleSidebar()">
        <label for="checkbox" class="toggle">
            <div class="bar bar--top"></div>
            <div class="bar bar--middle"></div>
            <div class="bar bar--bottom"></div>
        </label>


    </header>

        <form action="../config/processa-cadastro-veiculo.php" method="post">
            <div class="cadastro-veiculo">
                <div>
                    <label for="prop">Proprietário</label>
                    <input id="prop" type="text" name="proprietario" onkeyup="buscarProprietarios()" autocomplete="off">
                    <ul id="sugestoes" class="suggestions"></ul>
                </div>
                <div>
                    <label for="placa">Placa</label>
                    <input id="placa" type="text" name="placa" oninput="mascaraPlacaVeiculo(this)">
                </div>
                <div>
                    <label for="cor">Cor</label>
                    <input id="cor" name="cor" type="text">
                </div>
                <div>
                    <label for="tipo">Tipo Veículo</label>
                    <input id="tipo" name="tipo" type="text">
                </div>
                <div>
                    <label for="modelo">Modelo</label>
                    <input id="modelo" name="modelo" type="text">
                </div>
                <div>
                    <label for="marca">Marca</label>
                    <input id="marca" name="marca" type="text">
                </div>
                <button type="submit">Enviar</button>
            </div>

        </form>

    <script src="../js/script.js"></script>
    <script src="../js/popup-not.js"></script>
    <script src="../js/buscarProprietario.js"></script>
    <script src="../js/mascaras.js"></script>
</body>
</html>
<?php endif; ?>