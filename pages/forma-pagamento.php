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

    <title>Forma Pagamento</title>
</head>
<body>
<?php include '../includes/header-funci.php'; ?>

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
    </div>

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


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="../js/grid-forma-pagamento.js"></script>

</body>
</html>

<?php endif; ?>
