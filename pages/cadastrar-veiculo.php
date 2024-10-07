<?php
    session_start();
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
    <title>Cadastrar Veículo</title>
    <link rel="stylesheet" href="../css/style.css">
    <link href="../fontawesome/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/popup-not.css">
    <link rel="stylesheet" href="../css/cadastrar-veiculo.css">
    <link rel="stylesheet" href="../css/padraoformularios.css">
</head>
<body>

    <header>
        <div class="sidebar">
            <a href="../pages/home-funci.php">Home</a>
            <a href="../pages/cadastrar-funci.php">Cadastrar Funcionário</a>
            <a href="#clients">Clients</a>
            <a href="../config/sair.php">Sair</a>
        </div>

        <div class="container-header">
            <img src="../image/logo-carcheck.png" alt="Logo CarCheck" title="CarCheck">
            <h1>CarCheck</h1>
        </div>

        <div class="icons">
            <button onclick="showNotification()" class="icons-not">
                <i class="fa-solid fa-bell fa-2xl" style="color: #ffffff;"></i>
            </button>

            <div id="notification" class="notification">
                <span id="notification-text">Este é um alerta de notificação!</span>
                <span class="close-btn" onclick="closeNotification()">&times;</span>
            </div>

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

    <main>
        <h2 class="titulo-formulario">Cadastrar Veículo</h2>
        <form action="../config/processa-cadastro-veiculo.php" method="post">

         <div class="input-container">
            <div class="prop">
                <label for="prop">Proprietário</label>
                <input id="prop" type="text" name="proprietario" class="input" onkeyup="buscarProprietarios()" autocomplete="off">
                <ul id="sugestoes" class="suggestions"></ul>
            </div>
        </div>
            <div class="input-container">
                <label for="placa">Placa</label>
                <input id="placa" type="text" name="placa" class="input" oninput="mascaraPlacaVeiculo(this)">
            </div>
            
            <div class="input-container">
                <label for="modelo">Modelo</label>
                <input id="modelo" name="modelo" type="text" class="input">
            </div>
            <div class="input-container">
                <label for="tipo">Tipo Veículo</label>
                <input id="tipo" name="tipo" type="text" class="input">
            </div>
            <div class="input-container">
                <label for="cor">Cor</label>
                <input id="cor" name="cor" type="text" class="input">
            </div>
            <div class="input-container">
                <label for="marca">Marca</label>
                <input id="marca" name="marca" type="text" class="input">
            </div>
            <button type="submit">Enviar</button>
        </form>
    </main>

    <script src="../js/script.js"></script>
    <script src="../js/popup-not.js"></script>
    <script src="../js/buscarProprietario.js"></script>
    <script src="../js/mascaras.js"></script>
</body>
</html>
<?php endif ?>
