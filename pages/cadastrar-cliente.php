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
        
        <form action="../config/processa_dados.php" method="POST">
            
                


                <div class="cadastrar-cliente">
                    <div class="dados-pessoais">
                        <h2>Dados Pessoais</h2>


                        

                        <br>
                        <!-- select para indeficar se pessoa fisica ou juridica -->
                    
                        <label class="radio-button">
                        <input type="radio" name="tipo_pessoa" value="fisica">
                        <span class="radio"></span>
                        Pessoa Física.
                        </label>

                        <label class="radio-button">
                        <input type="radio" name="tipo_pessoa" value="juridica">
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
                                </div>
                                <div class="input-container">
                                    <label for="ie">IE</label>
                                    <input id="ie" name="ie" maxlength="20" placeholder="00.000.000.000" oninput="mascaraIE(this)" type="text" class="input">
                                    <div class="underline"></div>
                                </div>
                                <div class="input-container">
                                    <label for="razao-social">Razão Social</label>
                                    <input id="razao-social" name="razao-social"  placeholder="Digite sua Razão Social"  type="text" class="input">
                                    <div class="underline"></div>
                                </div>
                                <div class="input-container">
                                    <label for="nome-fantasia">Nome Fantasia</label>
                                    <input id="nome-fantasia" name="nome-fantasia"  placeholder="Digite seu Nome Fantasia" type="text" class="input">
                                    <div class="underline"></div>
                                </div>
                        </div>
                    </div>
                        
                    <br>
                    
                    <div class="endereco">
                    <h2>Endereço</h2>
                    <br>
                        
                        <div class="input-container">
                            <label for="estado">Estado:</label>
                            <input id="estado" name="estado" placeholder="Insira uma Estado" type="password" class="input">
                            <div class="underline"></div>
                        </div>

                        <!-- Botão para abrir o popup -->
                        <button class="open-popup-btn" type="button" onclick="openPopupEstado()">Cadastrar</button>
                        <!-- Popup (modal) -->
                        <div class="modal" id="modal-estado">
                            <div class="modal-content">
                                <span class="close-btn" onclick="closePopupEstado()">&times;</span>
                                <h2>Cadastro</h2>
                                <form action="../config/processa_dados.php" method="POST">
                                    <label for="estado-cadastro">Estado:</label>
                                    <input type="text" name="estado-cadastro"   id="">
                                    <button type="submit" class="submit-btn">Cadastrar</button>
                                </form>
                            </div>
                        </div>

                        <div class="input-container">
                            <label for="rua">Rua:</label>
                            <input id="rua" name="rua" placeholder="Digite sua Rua" type="text" class="input">
                            <div class="underline"></div>
                        </div>
                        <div class="input-container">
                            <label for="cidade">Cidade:</label>
                            <input id="cidade" name="cidade" placeholder="Digite sua Cidade" type="text" class="input">
                            <div class="underline"></div>
                        </div>
                        <div class="input-container">
                            <label for="numero">Numero:</label>
                            <input id="numero" name="numero" placeholder="Digite seu Numero" type="text" class="input">
                            <div class="underline"></div>
                        </div>
                        <div class="input-container">
                            <label for="bairro">Bairro:</label>
                            <input id="bairro" name="bairro" placeholder="Digite seu Bairro" type="text" class="input">
                            <div class="underline"></div>
                        </div>
                        <div class="input-container">
                            <label for="complemento">Complemento:</label>
                            <input id="complemento" name="complemento" placeholder="Digite seu Complemento" type="text" class="input">
                            <div class="underline"></div>
                        </div>
                        <div class="input-container">
                            <label for="cep">CEP:</label>
                            <input id="cep" name="cep" placeholder="Digite seu CEP" type="text" class="input">
                            <div class="underline"></div>
                        </div>
                        <div class="input-container">
                            <label for="ponto_ref">Ponto de Referência:</label>
                            <input id="ponto_ref" name="ponto_ref" placeholder="Digite seu Ponto de Referência" type="text" class="input">
                            <div class="underline"></div>
                        </div>
                    </div>
                    <button class="botao-submit" type="submit">ENVIAR</button>
                </div>
        
        </form>
    

    <script src="../js/pop-cadastro.js"></script>
    <script src="../js/valida-fisica-juridi.js"></script>
    <script src="../js/mascaras.js"></script>
    <script src="../js/script.js"></script>
    <script src="../js/popup-not.js"></script>
</body>
</html>
<?php endif; ?>