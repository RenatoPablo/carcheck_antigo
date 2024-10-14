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
    <title>Cadastro de Serviços</title>
    <link rel="stylesheet" href="../css/style.css">
    <link href="../fontawesome/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/popup-not.css">
    <link rel="stylesheet" href="../css/cadastro-servico.css">
    <link rel="stylesheet" href="../css/padraoformularios.css">
</head>
<body>

<?php include '../includes/header-funci.php'; ?>

    <main>
        <h2 class="titulo-formulario">Cadastro de Serviços e Produtos</h2>
            <form action="../config/processa-cadastro-servico.php" method="POST">

    <!-- Card para os dados do serviço -->
    <div class="form-card">
        <h3>Dados do Serviço</h3>

        <div class="input-container">
            <input type="radio" name="option" id="radio1" value="1" onclick="tornarProdutoReadOnly(); removerServicoReadOnly()">
            <label for="radio1">Selecionar Serviço</label>
        </div>

        <div class="input-container">
            <label for="nomeServico">Nome do Serviço</label>
            <input type="text" name="nomeServico" id="nomeServico" class="input">
        </div>

        <div class="input-container">
            <label for="descrServico">Descrição do Serviço</label>
            <input type="text" name="descrServico" id="descrServico" class="input">
        </div>

        <div class="input-container">
            <label for="valorServico">Valor</label>
            <input type="number" name="valorServico" id="valorServico" class="input">
        </div>
    </div>

    <!-- Card para os dados do produto -->
    <div class="form-card produto-card">
        <h3>Dados do Produto</h3>

        <div class="input-container">
            <input type="radio" name="option" id="radio2" value="2" onclick="removerProdutoReadOnly(); tornarServicoReadOnly();">
            <label for="radio2">Selecionar Produto</label>
        </div>

        <div class="inputs-produto">
            <!-- Nome do Produto -->
            <div class="input-container">
                <label for="nomeProduto">Nome do Produto</label>
                <input type="text" name="nomeProduto" id="nomeProduto" class="input">
            </div>

            <!-- Descrição do Produto -->
            <div class="input-container">
                <label for="descrProduto">Descrição do Produto</label>
                <input type="text" name="descrProduto" id="descrProduto" class="input">
            </div>

            <!-- Valor -->
            <div class="input-container">
                <label for="valorProduto">Valor</label>
                <input type="number" step="0.01" name="valorProduto" id="valorProduto" class="input">
            </div>

            <!-- Marca -->
            <div class="input-container">
                <label for="marcaProduto">Marca</label>
                <input type="text" id="marcaProduto" name="marcaProduto" class="input">
            </div>

            <!-- CNPJ do Fornecedor -->
            <div class="input-container">
                <label for="cnpjFornecedor">CNPJ do Fornecedor</label>
                <input type="text" name="cnpjFornecedor" id="cnpjFornecedor" class="input" oninput="mascaraCNPJ(this)" onkeyup="buscarFornecedores()">
                <ul id="sugestoes" class="suggestions"></ul>
            </div>

            <!-- Quantidade -->
            <div class="input-container">
                <label for="quantidadeProduto">Quantidade</label>
                <input type="number" name="quantidadeProduto" id="quantidadeProduto" class="input">
            </div>
        </div>
    </div>

    <!-- Botão de envio único -->
    <button type="submit" class="botao-submit">Enviar</button>
    </form>



    </main>

    <script src="../js/buscar-fornecedor.js"></script>
    <script src="../js/mascaras.js"></script>
    <script src="../js/readOnly-servico-produto.js "></script>
    

</body>
</html>
<?php endif; ?>
