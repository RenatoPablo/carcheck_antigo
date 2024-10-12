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
    <link rel="stylesheet" href="../css/home-funci.css"> <!-- CSS da Sidebar -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/card-itens.css">
    <link href="../fontawesome/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/popup-not.css">
    <title>Acesso Rápido</title>
</head>
<body>
    <?php include '../includes/header-funci.php'; ?>

    <div class="div-inicial">
        <h2>
            <?php
                if (isset($_SESSION['nomeUsuario'])) {
                    echo "Olá, " . htmlspecialchars($_SESSION['nomeUsuario']);
                }
            ?>
        </h2>
        <p class="div-inicial-p">O que você deseja fazer? Selecione uma das opções:</p>
        
        <div class="container-acesso">
            <!-- Cartões de acesso rápido -->
            <a href="cadastrar-cliente.php">
                <div class="card">
                <img src="../image/iconeCadastrarCliente.png" alt="Cadastrar Cliente" class="img-card">
                    <p class="heading">Cadastrar Cliente</p>
                </div>
            </a>
            <a href="../pages/cadastrar-veiculo.php">
                <div class="card">
                    <img src="../image/carro.png" alt="icone de carro" class="img-card-especifica">
                    <p class="heading">Cadastrar Veículos</p>
                </div>
            </a>
            <a href="">
                <div class="card">
                    <img src="../image/iconeConsultarOrdemServiço.png" alt="Consultar Ordem Serviço" class="img-card">
                    <p class="heading">Consultar Ordem de Serviço</p>
                </div>
            </a>
            <a href="../pages/cadastrar-servico.php">
                <div class="card">
                    <img src="../image/iconeCadastrarServiço.png" alt="Cadastrar Serviço ou Produto" class="img-card">
                    <p class="heading">Cadastrar Serviços</p>
                </div>
            </a>
            <a href="../pages/gerenciar-estoque.php">
                <div class="card">
                <img src="../image/iconeGerenciarEstoque.png" alt="Gerenciar Estoque" class="img-card">
                    <p class="heading">Gerenciar Estoque</p>
                </div>
            </a>
            <a href="../pages/emitir-ordem.php">
                <div class="card">
                    <img src="../image/iconeEmetirOrdemServiço.png" alt="icone emetir ordem de serviço" class="img-card">
                    <p class="heading">Emitir Ordem de Serviço</p>
                </div>
            </a>
        </div>
    </div>
    

    
</body>
</html>
<?php endif; ?>