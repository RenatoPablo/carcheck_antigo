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
    <link rel="stylesheet" href="../css/popup-not.css">
    <link rel="stylesheet" href="../css/popup-cadastro.css">
    
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
            <a href="pages/perfil.html"><i class="fa-solid fa-user fa-2xl" style="color: #ffffff;"></i></a>
        </div>
            <!-- Botão para abrir a Sidebar -->
            <input type="checkbox" id="checkbox" onclick="toggleSidebar()">
            <label for="checkbox" class="toggle">
                <div class="bar bar--top"></div>
                <div class="bar bar--middle"></div>
                <div class="bar bar--bottom"></div>
            </label>
        
    </header>

    
        <!-- <img class="imgCadastroPessoa" src="../image/perfilCadastro.png" alt="foto cadastro pessoa"> -->
        
        <form action="../config/processa_dados.php" method="post">
            
        

                <div class="cadastrar-cliente">
                    <div class="dados-pessoais">
                        <h2>Dados Pessoais</h2>


                        <!-- Botão para abrir o popup -->
                        <button class="open-popup-btn" onclick="openPopup()">Cadastrar</button>

                        <!-- Popup (modal) -->
                        <div class="modal" id="myModal">
                            <div class="modal-content">
                                <span class="close-btn" onclick="closePopup()">&times;</span>
                                <h2>Cadastro</h2>
                                <form action="processa_cadastro.php" method="POST">
                                    <input type="text" name="nome" placeholder="Nome completo" required>
                                    <input type="email" name="email" placeholder="Email" required>
                                    <input type="password" name="senha" placeholder="Senha" required>
                                    <input type="date" name="nascimento" placeholder="Data de nascimento">
                                    <button type="submit" class="submit-btn">Cadastrar</button>
                                </form>
                            </div>
                        </div>

                        <br>
                        <!-- select para indeficar se pessoa fisica ou juridica -->
                    
                        <label class="radio-button">
                            <input type="radio" name="example-radio" value="fisica">
                            <span class="radio"></span>
                            Pessoa Física.
                        </label>
                        <label class="radio-button">
                            <input type="radio" name="example-radio" value="juridica">
                            <span class="radio"></span>
                            Pessoa Jurídica
                        </label>
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
                                    <!-- <img src="../image/seta.png" alt="Logo CarCheck" title="CarCheck"> -->
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
                            <label for="email">Email:</label>
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
                            <label for="confirmarsenha">Confirmar Senha:</label>
                            <input id="confirmarsenha" name="confirmarsenha"placeholder="Confirme sua senha" type="password" class="input">
                            <div class="underline"></div>
                        </div>
                        <!-- campos especificos pessoa fisica/juridica -->
                        <div id="campos-fisica" class="especifico">
                            <div class="input-container">
                                <label for="cpf">CPF:</label>
                                <input id="cpf" name="cpf" maxlength="14" placeholder="000.000.000-00" oninput="mascaraCPF(this)" type="text" class="input">
                                <div class="underline"></div>
                            </div>

                            <div class="input-container">
                                <label for="cpf">RG:</label>
                                <input id="rg" name="rg" maxlength="13" placeholder="00.000.000-00" oninput="mascaraRG(this)" type="text" class="input">
                            <div class="underline"></div>
                            </div>
                        </div>
                        <div id="campos-juridica" class="especifico">
                            <div class="input-container">
                                <label for="cnpj">CNPJ:</label>
                                <input id="cnpj" name="cnpj" maxlength="18" placeholder="00.000.000/0000-00" oninput="mascaraCNPJ(this)" type="text" class="input">
                                <div class="underline"></div>
                            <div class="underline"></div>
                            <div class="input-container">
                                <label for="ie">IE</label>
                                <input id="ie" name="ie" maxlength="15" placeholder="00.000.000.000" oninput="mascaraIE(this)" type="text" class="input">
                                <div class="underline"></div>
                            </div>
                        </div>
                        <!-- <div class="input-container">
                            <label for="cpf">CPF:</label>
                            <input id="cpf" name="cpf" placeholder="Digite seu CPF" type="number" class="input">
                            <div class="underline"></div>
                        </div> -->
                    </div>
                    <br>
                    <h2>Endereço</h2>
                    <div class="endereco">
                        <div class="input-container">
                            <label for="senha">Estado:</label>
                            <input id="senha" name="senha" placeholder="Insira uma Senha" type="password" class="input">
                            <div class="underline"></div>
                        </div>
                        <div class="input-container">
                            <label for="nome">Rua:</label>
                            <input id="nome" name="nome" placeholder="Digite seu Nome" type="text" class="input">
                            <div class="underline"></div>
                        </div>
                        <div class="input-container">
                            <label for="nome">Cidade:</label>
                            <input id="nome" name="nome" placeholder="Digite seu Nome" type="text" class="input">
                            <div class="underline"></div>
                        </div>
                        <div class="input-container">
                            <label for="nome">Numero:</label>
                            <input id="nome" name="nome" placeholder="Digite seu Nome" type="text" class="input">
                            <div class="underline"></div>
                        </div>
                        <div class="input-container">
                            <label for="nome">Bairro:</label>
                            <input id="nome" name="nome" placeholder="Digite seu Nome" type="text" class="input">
                            <div class="underline"></div>
                        </div>
                        <div class="input-container">
                            <label for="nome">Complemento:</label>
                            <input id="nome" name="nome" placeholder="Digite seu Nome" type="text" class="input">
                            <div class="underline"></div>
                        </div>
                        <div class="input-container">
                            <label for="nome">CEP:</label>
                            <input id="nome" name="nome" placeholder="Digite seu Nome" type="text" class="input">
                            <div class="underline"></div>
                        </div>
                        <div class="input-container">
                            <label for="nome">Ponto de Referência:</label>
                            <input id="nome" name="nome" placeholder="Digite seu Nome" type="text" class="input">
                            <div class="underline"></div>
                        </div>
                    </div>
                </div>
        
            <button class="botao-submit" type="submit">ENVIAR</button>
        </form>
    

    <script src="../js/pop-cadastro.js"></script>
    <script src="../js/valida-fisica-juridi.js"></script>
    <script src="../js/mascaras.js"></script>
    <script src="../js/script.js"></script>
    <script src="../js/popup-not.js"></script>
</body>
</html>
<?php endif; ?>