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
    <link rel="stylesheet" href="../css/style.css">
    <link href="../fontawesome/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/padrao-cadastro.css">
    <title>Cadastro Cliente</title>
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
                <a href="#notificacao"><i class="fa-solid fa-bell fa-2xl" style="color: #ffffff;"></i></a>
                <a href="#home"><i class="fa-solid fa-house-chimney fa-2xl casa" style="color: #ffffff;"></i></a>
                <a href="#perfil"><i class="fa-solid fa-user fa-2xl" style="color: #ffffff;"></i></a>
            </div>
            <!-- Botão para abrir a Sidebar -->
            <button class="open-btn" onclick="toggleSidebar()">☰</button>
        
    </header>

    
        <!-- <img class="imgCadastroPessoa" src="../image/perfilCadastro.png" alt="foto cadastro pessoa"> -->
        
        <form action="../config/processa_dados.php" method="post">
            <div class="container-cadastro">
            
                <div class="input-container">
                    <label for="nome">Nome Completo:</label>
                    <input id="nome" name="nome" placeholder="Digite seu Nome" type="text" class="input">
                    <div class="underline"></div>
                </div>
                 <div class="input-container">
                    <div class="ls-custom-select">
                        <label for="genero">Gênero:</label>
                        <select id="genero" name="genero" class="escolha-genero" aria-label="selecione">
                            <option selected="">Selecione..</option>
                            <img src="../image/seta.png" alt="Logo CarCheck" title="CarCheck">
                            <option value="1">Masculino</option>
                            <option value="2">Feminino</option>
                            <option value="3">Outro</option>
                        </select>
                    </div>
                    <div class="underline"></div>
                </div>
                 <div class="input-container">
                    <label for="telefone">Telefone:</label>
                    <input id="telefone" name="telefone" placeholder="Digite seu Telefone" type="number" class="input">
                    <div class="underline"></div>
                </div>
                 <div class="input-container">
                    <label for="email">email:</label>
                    <input id="email" name="email" placeholder="Digite seu email" type="email" class="input">
                    <div class="underline"></div>
                </div>
                 <div class="input-container">
                    <label for="datadenascimento">Data de Nascimento:</label>
                    <input id="datadenascimento" name="datadenascimento" placeholder="Digite sua Data de Nascimento" type="date" class="input">
                    <div class="underline"></div>
                </div>
                 <div class="input-container">
                    <label for="senha">Senha:</label>
                    <input id="senha" name="senha" placeholder="Insira uma Senha" type="password" class="input">
                    <div class="underline"></div>
                </div>
                 <div class="input-container">
                    <label for="cpf">CPF:</label>
                    <input id="cpf" name="cpf" placeholder="Digite seu CPF" type="number" class="input">
                    <div class="underline"></div>
                </div>
                <div class="input-container">
                    <label for="confirmarsenha">Confirmar Senha:</label>
                    <input id="confirmarsenha" name="confirmarsenha"placeholder="Confirme sua senha" type="password" class="input">
                    <div class="underline"></div>
                </div>
                <button type="submit">ENVIAR</button>
            </div>
        </form>
    

    


    <script src="../js/script.js"></script>
</body>
</html>
<?php endif; ?>