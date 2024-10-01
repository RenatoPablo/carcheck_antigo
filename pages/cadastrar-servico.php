<?php
    session_start();
    // print_r($_SESSION);
    if(!isset($_SESSION) OR $_SESSION['logado'] != true):
		header("location: ../config/sair.php");		
	else:

    $permissao = $_SESSION['permissaoUsuario'];
?>
<!DOCTYPE html>
<html lang="pt-bt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Serviços</title>
    <link rel="stylesheet" href="../css/style.css">
    <link href="../fontawesome/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/popup-not.css">
    <link rel="stylesheet" href="../css/cadastro-servico.css">
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

        <form action="../config/processa-cadastro-servico.php" method="post">
            <div class="servicos">
                <div>
                    <label for="nome">Nome serviço:</label>
                    <input type="text" name="nome" id="nome">
                </div>
                <div>
                    <label for="descr">Descrição serviço:</label>
                    <input type="text" name="descr" id="descr">
                </div>
                <div>
                    <label for="valor">Valor:</label>
                    <input type="number" name="valor" id="valor">
                </div>
                <div>
                    <label for="tipo">Tipo: </label>
                    <select name="tipo" id="tipo">
                        <option selected="">Selecione</option>
                        <option value="1">Serviço</option>
                        <option value="2">Peças</option>
                    </select>
                </div>
                <div>
                    <label for="marca">Marca: </label>
                    <input type="text" id="marca" name="marca">
                </div>
            </div>
            <button type="submit">Enviar</button>
        </form>

    <script src="../js/script.js"></script>
    <script src="../js/popup-not.js"></script>
</body>
</html>
<?php endif ?>