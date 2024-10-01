<?php
    session_start();
    // print_r($_SESSION);
    if(!isset($_SESSION) OR $_SESSION['logado'] != true):
		header("location: ../config/sair.php");		
	else:

    $permissao = $_SESSION['permissaoUsuario'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emitir ordem de serviço</title>
    <link rel="stylesheet" href="../css/style.css">
    <link href="../fontawesome/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/popup-not.css">


    <!-- adicionando para teste apenas -->
     <style>
        form {
            position: relative;
            top: 200px;
        }
     </style>
</head>
<body>
    <header>

    <!-- Sidebar -->
    <div class="sidebar">
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

        <?php if($permissao == 2 || $permissao == 3) : ?>
            <a href="../pages/home-funci.php"><i class="fa-solid fa-house-chimney fa-2xl casa" style="color: #ffffff;"></i></a>
        <?php endif; ?>

        <?php if($permissao == 1) : ?>
            <a href="../pages/home-cliente.php"><i class="fa-solid fa-house-chimney fa-2xl casa" style="color: #ffffff;"></i></a>
        <?php endif; ?>
        <a href="../pages/perfil.php"><i class="fa-solid fa-user fa-2xl" style="color: #ffffff;"></i></a>
    </div>
    <input type="checkbox" id="checkbox" onclick="toggleSidebar()">
    <label for="checkbox" class="toggle">
        <div class="bar bar--top"></div>
        <div class="bar bar--middle"></div>
        <div class="bar bar--bottom"></div>
    </label>
    </header>

            <form action="">
                <label for="time-inicio">Hora de entrada:</label>
                <input type="datetime" name="time-inicio" id="time-inicio">

                <br>

                <label for="time-final">Hora de saída:</label>
                <input type="datetime" name="time-final" id="time-final">

                <br>

                <label for="km">KM:</label>
                <input type="number" name="km" id="km">

                <br>

                <label for="defeito">Defeito observado:</label>
                <input type="text" name="defeito" id="defeito">

                <br>

                <label for="veiculo">Carro:</label>
                <input type="text" name="veiculo" id="veiculo">

                <br>

                <label for="placa">Placa:</label>
                <input type="text" name="placa" id="placa" oninput="mascaraPlacaVeiculo(this)"
                onkeyup="buscarVeiculo()">

                <br>

                <label for="prop">Proprietário do veiculo</label>
                <input id="prop" type="text" name="proprietario" class="input" onkeyup="buscarProprietarios()" autocomplete="off">
                    <ul id="sugestoes" class="suggestions"></ul>

                <div>
                    <h2>Area para adicionar serviços e peças</h2>
                    <label for="servico">Adicionar serviços</label>
                    <input placeholder="Buscar item do estoque" type="text" id="estoqueServico"  name="servico" onkeyup="buscarEstoqueServico()"/>

                    <ul id="sugestoesServico"></ul>

                    <br>
                    <label for="produto">Adicionar peças</label>
                    <input placeholder="Buscar item do estoque" type="text" id="estoqueProduto"  name="produto" onkeyup="buscarEstoqueProduto()"/>

                    <ul id="sugestoesProduto"></ul>

                </div>
            </form>

    <script src="../js/buscar-estoque.js"></script>
    <script src="../js/buscarProprietario.js"></script>
    <script src="../js/buscar-veiculo.js"></script>
    <script src="../js/mascaras.js"></script>
    <script src="../js/script.js"></script>
    <script src="../js/popup-not.js"></script>
</body>
</html>

<?php endif ?>