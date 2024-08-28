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
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/home-cliente.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/card-itens.css">
    <title>CarCheck</title>
    <link href="../fontawesome/css/all.css" rel="stylesheet">
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
            <a href="pages/notificacao.html"><i class="fa-solid fa-bell fa-2xl" style="color: #ffffff;"></i></a>

            <a href="pages/home.html"><i class="fa-solid fa-house-chimney fa-2xl casa" style="color: #ffffff;"></i></a>

            <a href="pages\perfil.html"><i class="fa-solid fa-user fa-2xl" style="color: #ffffff;"></i></a>
            
            <button class="open-btn" onclick="toggleSidebar()">☰</button>
        </div>
        
        
    </header>

        <!--div que contem os itens do acesso rapido-->
        <div class="container-acesso-rapido"> 
            <h2 class="textoh2">ACESSO RÁPIDO</h2>
            <div class="container-acesso">
                
                <a href="">
                    <div class="card">
                        <p class="heading">Veículos</p>
                    </div>
                </a>
                <a href="">
                    <div class="card">
                        <p class="heading">Serviços</p>
                    </div>
                </a>

                <a href="">
                    <div class="card">
                        <p class="heading">Agendamento</p>
                    </div>
                </a>

                <a href="">
                    <div class="card">
                        <p class="heading">Associados</p>
                    </div>
                </a>

                
            </div>
        </div>
    
    <script src="../js/script.js"></script>
</body>
</html>
<?php endif; ?>