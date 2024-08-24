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
<?php
// Inicia a sessão no início do script
session_start();

// Variáveis de login predefinidas
$admUsername = "renato";
$admPassword = "123";

$clientUsername = "joao";
$clientPassword = "123";

// Mensagem de erro
$error = "";

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validação simples de login
    if ($username === $admUsername && $password === $admPassword) {
        header('Location: home-funci.html');
        exit();
    } elseif ($username === $clientUsername && $password === $clientPassword) {
        header('Location: home-cliente.html');
        exit();
    } else {
        // Define a mensagem de erro na sessão
        $_SESSION['error'] = "Usuário ou senha incorretos!";
        header('Location: login.php'); // Redireciona de volta para a página de login
        exit();
    }
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
            <form id="login-form" method="POST" class="form-login">
                <input class="input" type="text" id="username" name="username" required placeholder="Digite seu Login">
                <br>
                <input class="input" type="password" id="password" name="password" required placeholder="Digite sua Senha">
                
                <label class="label-lembrar-me">
                    <input type="checkbox" name="opcao1" value="valor1">
                    <p>Lembrar-me</p>
                    <a href="">
                        <p class="p-esqueci">Esqueci minha senha</p>
                    </a>
                </label>
                
                <?php if (isset($_SESSION['error'])): ?>
                    <p class="error-message"><?php echo htmlspecialchars($_SESSION['error']); ?></p>
                    <?php unset($_SESSION['error']); // Limpa a mensagem de erro após exibi-la ?>
                <?php endif; ?>

                <button type="submit">
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

