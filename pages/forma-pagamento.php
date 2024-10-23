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
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/popup-not.css">
    <link rel="stylesheet" href="../css/forma-pagamento.css">
    <link href="../fontawesome/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<<<<<<< Updated upstream
    <title>Gerenciamento de Itens</title>

    <style>
        .position {
            position: relative;
            top: 100px;
        }
        
        /* Estilo para o botão de abrir modal */
        .btn-cadastrar {
            background-color: #0D3587;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-cadastrar:hover {
            background-color: #0a2c6b;
        }

        /* Estilo geral para o modal */
        .modal-geral {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
        }

        /* Estilo do conteúdo do modal */
        .modal-content {
            background-color: white;
            margin: 10% auto;
            padding: 30px;
            border-radius: 10px;
            width: 40%;
            position: relative;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Estilo para o botão de fechar o modal */
        .modal-close {
            color: #999;
            position: absolute;
            right: 20px;
            top: 15px;
            font-size: 24px;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .modal-close:hover {
            color: black;
        }

        /* Estilo do formulário dentro do modal */
        .modal-geral form {
            display: flex;
            flex-direction: column;
        }

        /* Estilo para cada input-container no formulário */
        .input-container {
            margin-bottom: 20px;
        }

        .input-container label {
            font-size: 14px;
            color: #333;
            margin-bottom: 8px;
            display: block;
        }

        .input-container input {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        /* Estilo para o botão de salvar */
        .btn-salvar {
            background-color: #0D3587;
            color: white;
            padding: 12px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-salvar:hover {
            background-color: #0a2c6b;
        }

        /* Estilo para o campo de busca com ícone de lupa */
        .search-bar {
            position: relative;
            width: 100%;
        }

        .search-bar input {
            width: 100%;
            padding: 10px 40px 10px 20px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .search-bar .icon-search {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 20px;
            color: #0D3587;
        }

    </style>
=======

    <title>Forma Pagamento</title>
>>>>>>> Stashed changes
</head>
<body>
<?php include '../includes/header-funci.php'; ?>

<<<<<<< Updated upstream
<div class="position">
    <h2>Gerenciamento de Itens</h2>

    <!-- Botão para abrir o modal -->
    <button id="btnAbrirModalCadastro" class="btn-cadastrar">Cadastrar Novo Item</button>

    <!-- Campo de busca -->
    <div class="search-bar mb-3">
        <input type="text" id="inputBusca" placeholder="Buscar item..." class="form-control">
        <span class="icon-search"><i class="fa fa-search"></i></span>
    </div>

    <!-- Modal para cadastro de item -->
    <div id="modalCadastro" class="modal-geral">
        <div class="modal-content">
            <span class="modal-close">&times;</span>
            <h2>Cadastrar Novo Item</h2>
            
            <!-- Formulário de cadastro -->
            <form id="formCadastro" method="POST" action="../config/adicionar-item.php">
                <div class="input-container">
                    <label for="inputNome">Nome do Item:</label>
                    <input type="text" id="inputNome" name="nomeItem" required>
                </div>

                <button type="submit" class="btn-salvar">Salvar</button>
            </form>
        </div>
=======
<div class="container mt-4">
    <h2>Formas de Pagamento</h2>
    
    <!-- Botão para abrir o modal -->
    <button id="openModal" class="btn-cadastrar">Cadastrar Forma de Pagamento</button>

    <!-- Tabela para listar as formas de pagamento -->
    <table class="table-list">
        <thead>
            <tr>
                <th>Nome da Forma de Pagamento</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Cartão de Crédito</td>
                <td class="actions">
                    <button class="btn btn-primary btn-sm" onclick="openModal('update', 'Cartão de Crédito')">Editar</button>
                    <button class="btn btn-danger btn-sm" onclick="openModal('delete', 'Cartão de Crédito')">Excluir</button>
                </td>
            </tr>
            <tr>
                <td>Boleto Bancário</td>
                <td class="actions">
                    <button class="btn btn-primary btn-sm" onclick="openModal('update', 'Boleto Bancário')">Editar</button>
                    <button class="btn btn-danger btn-sm" onclick="openModal('delete', 'Boleto Bancário')">Excluir</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<!-- Modal para cadastro -->
<div class="modal-forma-pagamento" id="cadastroModal">
    <div class="modal-content-forma">
        <span class="modal-close">&times;</span>
        <h2>Cadastrar Forma de Pagamento</h2>
        
        <!-- Formulário de cadastro -->
        <form id="cadastroForm" method="POST" action="../config/forma-pagamento/adicionar-forma-pagamento.php">
            <div class="input-container-forma">
                <label for="formaPagamento">Forma de Pagamento:</label>
                <input type="text" id="cadastroInput" name="formaPagamento" required>
            </div>

            <button type="submit" class="btn-salvar">Salvar</button>
        </form>
>>>>>>> Stashed changes
    </div>

<<<<<<< Updated upstream
    <div class="container mt-4">
        <h2>Lista de Itens</h2>
        <div class="row">
            <div class="col-8"><strong>Nome do Item</strong></div>
            <div class="col-4"><strong>Ações</strong></div>
        </div>
        <div id="gridResultadoBusca">
            <!-- Os resultados da grid aparecerão aqui -->
        </div>
    </div>
</div>

=======
>>>>>>> Stashed changes
<!-- Modal para Update e Delete -->
<div class="modal fade" id="modalAcao" tabindex="-1" aria-labelledby="modalTituloAcao" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTituloAcao">Ação</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="mensagemModalAcao"></p>
                <form id="formUpdate" class="d-none">
                    <div class="mb-3">
                        <label for="inputUpdateNome" class="form-label">Nome do Item</label>
                        <input type="text" class="form-control" id="inputUpdateNome" name="nomeItem" value="">
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                </form>
                <button id="btnConfirmarDelete" class="btn btn-danger d-none">Confirmar Exclusão</button>
            </div>
        </div>
    </div>
</div>

<<<<<<< Updated upstream
<script>


</script>
=======
<script src="../js/grid-forma-pagamento.js"></script>
>>>>>>> Stashed changes
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="../js/grid-forma-pagamento.js"></script>

</body>
</html>

<?php endif; ?>
