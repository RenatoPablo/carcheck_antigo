<?php
    session_start();
    if(!isset($_SESSION) OR $_SESSION['logado'] != true):
        header("location: ../config/sair.php");
    else:
        $permissao = $_SESSION['permissaoUsuario'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Veículo</title>
    <link rel="stylesheet" href="../css/style.css">
    <link href="../fontawesome/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/popup-not.css">
    <link rel="stylesheet" href="../css/cadastrar-veiculo.css">
    <link rel="stylesheet" href="../css/padraoformularios.css">
</head>
<body>

<?php include '../includes/header-funci.php'; ?>

    <main>
        <h2 class="titulo-formulario">Cadastrar Veículo</h2>
        <form action="../config/processa-cadastro-veiculo.php" method="post">

         <div class="input-container">
            <div class="prop">
                <label for="prop">Proprietário</label>
                <input id="prop" type="text" name="proprietario" class="input" onkeyup="buscarProprietarios()" autocomplete="off">
                <ul id="sugestoes" class="suggestions"></ul>
            </div>
        </div>
            <div class="input-container">
                <label for="placa">Placa</label>
                <input id="placa" type="text" name="placa" class="input" oninput="mascaraPlacaVeiculo(this)">
            </div>
            
            <div class="input-container">
                <label for="modelo">Modelo</label>
                <input id="modelo" name="modelo" type="text" class="input">
            </div>
            <div class="input-container">
                <label for="tipo">Tipo Veículo</label>
                <input id="tipo" name="tipo" type="text" class="input">
            </div>
            <div class="input-container">
                <label for="cor">Cor</label>
                <input id="cor" name="cor" type="text" class="input">
            </div>
            <div class="input-container">
                <label for="marca">Marca</label>
                <input id="marca" name="marca" type="text" class="input">
            </div>
            <button type="submit">Enviar</button>
        </form>
    </main>

    
    <script src="../js/buscarProprietario.js"></script>
    <script src="../js/mascaras.js"></script>
</body>
</html>
<?php endif ?>
