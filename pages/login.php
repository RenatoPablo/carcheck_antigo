<?php 
    if(isset($_POST['submit'])) {
        include_once('../config/config.php');

        $email = $_POST['endereco_email'];
        $senha = $_POST['senha'];
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <link href="../fontawesome/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/botao.css">
    
    <title>Login-CarCheck</title>
</head>
<body>
    <div class="container-esquerdo">
        <div class="texto-esquerdo">
            <h1>Olá,<br> Seja Bem Vindo!</h1>
            <p>Faça Login e obtenha acesso ao nosso sistema.</p>
        </div>
    </div>

    <div class="container-direito">
        <div class="dados">
            <i class="fa-regular fa-user fa-2xl usuario" style="color: #0d3587;"></i>

            <form action="../config/validaLogin.php" method="POST" class="form-login">
                <input class="input" type="text"  name="endereco_email" required placeholder="Digite seu Email">
                <br>
                <input class="input" type="password"  name="senha" required placeholder="Digite sua Senha">
                
                <label class="label-lembrar-me">
                    <input type="checkbox" name="opcao1" value="valor1">
                    <p>Lembrar-me</p>
                    <a href="">
                        <p class="p-esqueci">Esqueci minha senha</p>
                    </a>
                </label>
                
                

                <button type="submit" name="submit">
                    Entrar
                    <div class="arrow-wrapper">
                        <div class="arrow"></div>
                    </div>
                </button>

                
            </form>
        </div>
    </div>
    
</body>
</html>

