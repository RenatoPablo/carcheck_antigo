<?php

    session_start();
    // print_r($_SESSION);
    if(!isset($_SESSION) OR $_SESSION['logado'] != true):
        header("location: ../config/sair.php");		
    else:

    require '../config/config.php';

    try{
        //preparar consulta
        $sql = "
        SELECT nome_pessoa, endereco_email
        FROM pessoas
        WHERE nome_pessoa = :nome";
        $stmt = $pdo->prepare($sql);

        //executar consulta
        $stmt->execute([':nome' => $_SESSION['nomeUsuario']]);

        //pega todos os resultados em um array associado
        $resultados = $stmt->fetch(PDO::FETCH_ASSOC);

        // if ($resultados) {
        //     foreach($resultados as $linhas) {
        //         //exibir nome e email de casa usuario
        //         echo "<p>Nome: ". htmlspecialchars($linhas['nome_pessoa']) . "</p>";
        //         echo "<p>Email: " . htmlspecialchars($linhas['endereco_email']) . "</p>";
        //         echo "<hr>";
        //     }
        // } else {
        //     echo "<p>Nenhum usuario encontrado</p>";
        // }



    } catch(PDOException $e){
        echo "ERRO: " . $e->getMessage();
    }

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

    <a href="pages/home.html"><i class="fa-solid fa-house-chimney fa-2xl casa" style="color: #ffffff;"></i></a>
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

    <div class="dados_perfil">
        <label>Nome: <?php echo $resultados['nome_pessoa'] ?></label>
        <br>
        <label>Email: <?php echo $resultados['endereco_email']?></label>
    </div>

</body>
</html>
<?php endif; ?>