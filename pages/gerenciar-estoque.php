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
    <title>Gerenciar estoque</title>
    <link rel="stylesheet" href="../css/barra-pesquisa.css">
    <link rel="stylesheet" href="../css/gerenciar-estoque.css">
    <link href="../fontawesome/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/popup-not.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/style-busca-estoque.css">
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

<div class="busca">
    
        <!-- barra de pesquisa -->
        <div class="search">
          <input placeholder="Buscar item do estoque" class="search__input" type="text" id="estoque" onkeyup="buscarEstoque()"/>
          <button class="search__button">
            <svg
              viewBox="0 0 16 16"
              class="bi bi-search"
              fill="currentColor"
              height="16"
              width="16"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"
              ></path>
            </svg>
          </button>
        </div>
    
        <!-- Checkboxes para tipo de produto -->
        <label>
            <input type="radio" name="tipo" value="1"> Serviço
        </label>
        <label>
            <input type="radio" name="tipo" value="2"> Produto
        </label>
    
        <!-- Sugestões aparecerão aqui -->
        <ul id="sugestoes"></ul>
</div>


<!-- Modal (inicialmente oculto) -->
<div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p id="modal-text">Detalhes do produto/serviço...</p> <!-- Aqui serão exibidos detalhes do item -->
        </div>
</div>


<script src="../js/buscar-estoque.js"></script>
<script src="../js/script.js"></script>
<script src="../js/popup-not.js"></script>
</body>
</html>
<?php endif; ?>