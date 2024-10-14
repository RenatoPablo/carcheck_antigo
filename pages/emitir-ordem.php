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
    <title>Emitir ordem de serviço</title>
    <link rel="stylesheet" href="../css/style.css">
    <link href="../fontawesome/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/popup-not.css">
    <link rel="stylesheet" href="../css/emitir-ordem.css">
    
    <style>
        .ul-temporaria {
            list-style-type: none;
            padding: 0;
            margin: 10px 0;
            border: 1px solid #ccc;
            background: #f9f9f9;
            max-height: 150px;
            overflow-y: auto;
        }
        .quantidade-input {
            width: 50px;
            margin-left: 10px;
        }
        .suggestions {
            list-style-type: none;
            padding: 0;
            margin: 0;
            background-color: white;
            border: 1px solid #ccc;
            max-height: 150px;
            overflow-y: auto;
        }
        .suggestions li {
            padding: 8px;
            cursor: pointer;
        }
        .suggestions li:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
<?php include '../includes/header-funci.php'; ?>

    <div class="area-dados">
        <div class="card">
            <form id="finalForm" action="../config/adicionar-manutencao.php" method="POST">
                <div class="campos">
                    <div class="dados">
                        <label class="label-campos" for="time-final">Hora de saída:</label>
                        <br>
                        <input type="datetime" name="time-final" id="time-final">
                    </div>
                
                    <div class="dados">
                        <label class="label-campos" for="km">KM:</label>
                        <br>
                        <input type="number" name="km" id="km">
                    </div>
                
                    <div class="dados">
                        <label class="label-campos" for="defeito">Defeito observado:</label>
                        <br>
                        <input type="text" name="defeito" id="defeito">
                    </div>
                
                    <div class="dados">
                        <label class="label-campos" for="placa">Placa:</label>
                        <br>
                        <input type="text" name="placa" id="placa" oninput="mascaraPlacaVeiculo(this)" onkeyup="buscarVeiculo()">
                    </div>

                    <div class="dados">
                        <label class="label-campos" for="veiculo">Carro:</label>
                        <br>
                        <input type="text" name="veiculo" id="veiculo">
                    </div>                          

                    <div class="dados">
                        <label class="label-campos" for="prop">Proprietário do veiculo</label>
                        <br>
                        <input id="prop" type="text" name="proprietario" class="input" onkeyup="buscarProprietarios()" autocomplete="off">
                        <ul id="sugestoes" class="suggestions"></ul>
                    </div>
                </div>
                
            
        </div>

        <div class="area-servico-produto">
            <h2>Área para adicionar serviços e peças</h2>

            <!-- Adicionar Serviços -->
            <label for="servico">Adicionar serviços</label>
            <input placeholder="Buscar item do estoque" type="text" id="estoqueServico" name="servico" onkeyup="buscarEstoqueServico()"/>
            <ul id="sugestoesServico" class="suggestions"></ul>

            <!-- Campo de quantidade de serviços -->
            <input type="number" id="quantidadeServico" class="quantidade-input" placeholder="Quantidade" style="display: none;"/>
            <button id="addItemBtnServico" style="display: none;" onclick="adicionarItemServico()">Adicionar à lista</button>

            <!-- Lista de serviços adicionados -->
            <ul id="itemListServico" class="ul-temporaria"></ul>

            <br>

            <!-- Adicionar Peças -->
            <label for="produto">Adicionar peças</label>
            <input placeholder="Buscar item do estoque" type="text" id="estoqueProduto" name="produto" onkeyup="buscarEstoqueProduto()"/>
            <ul id="sugestoesProduto" class="suggestions"></ul>

            <!-- Campo de quantidade de peças -->
            <input type="number" id="quantidadeProduto" class="quantidade-input" placeholder="Quantidade" style="display: none;"/>
            <button id="addItemBtnProduto" style="display: none;" onclick="adicionarItemProduto()">Adicionar à lista</button>

            <!-- Lista de peças adicionadas -->
            <ul id="itemListProduto" class="ul-temporaria"></ul>

            <label for="valorTotal">Valor total da nota:</label>
            <input type="text" name="valorTotal" id="valorTotal" readonly oninput="mascaraValor()">
        </div>

        
            <!-- inputs para adicionar itens ao array -->
            <input type="hidden" id="hiddenItemListServico" name="itemListServico">
            <input type="hidden" id="hiddenItemListProduto" name="itemListProduto">

            <button type="submit">Enviar</button>
        </form>
    </div>

    <script>
        function definirHoraAtualTime() {
            const agora = new Date();
            const horas = agora.getHours().toString().padStart(2, '0');
            const minutos = agora.getMinutes().toString().padStart(2, '0');
            document.getElementById('time-final').value = `${horas}:${minutos}`;
        }
        window.onload = definirHoraAtualTime;
    </script>

    <script src="../js/adicionar-lista.js"></script>
    
    <script src="../js/buscarProprietario.js"></script>
    <script src="../js/buscar-veiculo.js"></script>
    <script src="../js/mascaras.js"></script>
</body>
</html>

<?php endif ?>