<?php

    session_start();
    // print_r($_SESSION);
    if(!isset($_SESSION) OR $_SESSION['logado'] != true):
        header("location: ../config/sair.php");		
    else:

    $permissao = $_SESSION['permissaoUsuario'];

    require '../config/config.php';
    require '../config/busca-perfil.php';
    

    
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/card-itens.css"><link href="../fontawesome/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/popup-not.css">
    <link rel="stylesheet" href="../css/perfil.css">

    <title>Meu Perfil</title>
</head>
<body>
<header>

<!-- Sidebar -->
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
    <!-- Botão para abrir a Sidebar -->
    <input type="checkbox" id="checkbox" onclick="toggleSidebar()">
    <label for="checkbox" class="toggle">
        <div class="bar bar--top"></div>
        <div class="bar bar--middle"></div>
        <div class="bar bar--bottom"></div>
    </label>

</header>

    
    <div class="card-perfil">

        <!-- para mostrar a foto -->
        <?php if(!empty($foto)) :?>
        <div>
            <img src="<?php echo $foto; ?>" alt="Foto de perfil de <?php echo $nome; ?>">
        </div>
        <?php else: ?>
        <p>Sem foto de perfil cadastrada</p>
        <?php endif; ?>
        
        <label>Nome: <?php echo $nome ?></label>

        <br>

        <label>Email: <?php echo $email ?></label>

        <br>

        <label>Data nascimento: <?php echo $data_nasc ?></label>

        <br>

        <label>Telefone: <?php echo $telefone ?></label>

        <br>

        <label>CEP: <?php echo $cep ?></label>

        <br>

        <label>Rua: <?php echo $rua ?></label>

        <br>

        <label>Genero: <?php echo $sexo ?></label>

        <br>

        <label>Numero da casa: <?php echo $num_casa ?></label>

        <br>

        <label>Cidade: <?php echo $cidade ?></label>

        <br>

        <label>Bairro: <?php echo $bairro ?></label>

        <br>

        <?php if ($comple != null) : ?>
        <label>Complemento: <?php echo $comple ?></label>
        <?php else: ?>
        <p>Sem complemento</p>
        <?php endif; ?>
        
        <br>

        <?php if ($referencia != null) : ?>
        <label>Ponto de referencia: <?php echo $referencia ?></label>
        <?php else: ?>
        <p>Sem ponto de referencia</p>
        <?php endif; ?>
    </div>

    <script src="../js/script.js"></script>
</body>
</html>
<?php endif; ?>