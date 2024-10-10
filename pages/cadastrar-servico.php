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
    <title>Cadastro de Serviços</title>
    <link rel="stylesheet" href="../css/style.css">
    <link href="../fontawesome/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/popup-not.css">
    <link rel="stylesheet" href="../css/cadastro-servico.css">
    <link rel="stylesheet" href="../css/padraoformularios.css">
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
                <i class="fa-solid fa-bell fa-2xl" style="color: #ffffff;"></i>
            </button>

            <!-- Popup de notificação -->
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
        <h2 class="titulo-formulario">Cadastro de Serviços</h2>
        <form action="../config/processa-cadastro-servico.php" method="post" >

            <div class="servicos">
                <input type="radio" name="option" id="radio1" value="1" onclick="tornarProdutoReadOnly(); removerServicoReadOnly()">

                <div class="input-container">
                    <label for="nomeServico">Nome do Serviço</label>
                    <input type="text" name="nomeServico" id="nomeServico" class="input">
                </div>

                <div class="input-container">
                    <label for="descrServico">Descrição do Serviço</label>
                    <input type="text" name="descrServico" id="descrServico" class="input">
                </div>

                <div class="input-container">
                    <label for="valorServico">Valor</label>
                    <input type="number" name="valorServico" id="valorServico" class="input">
                </div>

                

                
            </div>

            <div class="produtos">
                <input type="radio" name="option" id="radio2" value="2" onclick="removerProdutoReadOnly(); tornarServicoReadOnly();">

                <div class="input-container">
                    <label for="nomeProduto">Nome do Produto</label>
                    <input type="text" name="nomeProduto" id="nomeProduto" class="input">
                </div>

                <div class="input-container">
                    <label for="descrProduto">Descrição do Produto</label>
                    <input type="text" name="descrProduto" id="descrProduto" class="input">
                </div>

                <div class="input-container">
                    <label for="valorProduto">Valor</label>
                    <input type="number" name="valorProduto" id="valorProduto" class="input">
                </div>

                <div class="input-container">
                    <label for="marcaProduto">Marca</label>
                    <input type="text" id="marcaProduto" name="marcaProduto" class="input">
                </div>
            </div>

            <button type="submit" class="botao-submit">Enviar</button>
        </form>
    </main>

    
    <script src="../js/readOnly-servico-produto.js "></script>
    <script src="../js/script.js"></script>
    <script src="../js/popup-not.js"></script>

</body>
</html>
<?php endif; ?>
