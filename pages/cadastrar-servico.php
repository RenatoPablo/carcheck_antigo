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
        <h2 class="titulo-formulario">Cadastro de Serviços</h2>
        <form action="../config/processa-cadastro-servico.php" method="post" >

            <div class="servicos">
                <input type="radio" name="option" id="radio1" value="1" onclick="tornarProdutoReadOnly(); removerServicoReadOnly()">

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

            <div class="produtos">
    <!-- Botão de rádio para selecionar a opção de produto -->
    <input type="radio" name="option" id="radio2" value="2" onclick="removerProdutoReadOnly(); tornarServicoReadOnly();">

    <!-- Campo para o nome do produto -->
    <div class="input-container">
        <label for="nomeProduto">Nome do Produto</label>
        <input type="text" name="nomeProduto" id="nomeProduto" class="input" required>
    </div>

    <!-- Campo para a descrição do produto -->
    <div class="input-container">
        <label for="descrProduto">Descrição do Produto</label>
        <input type="text" name="descrProduto" id="descrProduto" class="input" required>
    </div>

    <!-- Campo para o valor do produto -->
    <div class="input-container">
        <label for="valorProduto">Valor</label>
        <input type="number" step="0.01" name="valorProduto" id="valorProduto" class="input" required>
    </div>

    <!-- Campo para a marca do produto -->
    <div class="input-container">
        <label for="marcaProduto">Marca</label>
        <input type="text" id="marcaProduto" name="marcaProduto" class="input">
    </div>

    <!-- Campo para o CNPJ do fornecedor com sugestões -->
    <div class="input-container">
        <label for="cnpjFornecedor">CNPJ do Fornecedor</label>
        <input type="text" name="cnpjFornecedor" id="cnpjFornecedor" class="input" oninput="mascaraCNPJ(this)" onkeyup="buscarFornecedores()" required>
        <ul id="sugestoes" class="suggestions"></ul>
    </div>

    <div class="input-container">
        <label for="quantidadeProduto">Quantidade</label>
        <input type="number" name="quantidadeProduto" id="quantidadeProduto" class="input" required>
    </div>

</div>


            <button type="submit" class="botao-submit">Enviar</button>
        </form>
    </main>

    <script src="../js/buscar-fornecedor.js"></script>
    <script src="../js/mascaras.js"></script>
    <script src="../js/readOnly-servico-produto.js "></script>
    

</body>
</html>
<?php endif; ?>
