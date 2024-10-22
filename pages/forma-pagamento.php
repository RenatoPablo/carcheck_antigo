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
    <link href="../fontawesome/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    

    <title>Forma Pagamento</title>

    <style>
        .position{
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
.modal-forma-pagamento {
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
.modal-content-forma {
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
.modal-forma-pagamento form {
    display: flex;
    flex-direction: column;
}

/* Estilo para cada input-container no formulário */
.input-container-forma {
    margin-bottom: 20px;
}

.input-container-forma label {
    font-size: 14px;
    color: #333;
    margin-bottom: 8px;
    display: block;
}

.input-container-forma input {
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


    </style>
   
</head>
<body>
<?php include '../includes/header-funci.php'; ?>

<div class="position">
    <h2>Exibição de Dados no Grid</h2>

    <!-- Botão para abrir o modal -->
<button id="openModal" class="btn-cadastrar">Cadastrar Forma de Pagamento</button>

<!-- Modal para cadastro de forma de pagamento -->
<div id="cadastroModal" class="modal-forma-pagamento">
    <div class="modal-content-forma"> <!-- Corrigido aqui -->
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
    </div>
</div>

    
    <div class="container mt-4">
        <h2>Formas de Pagamento</h2>
        <div class="row">
            <!-- Cabeçalhos da Grid -->
            <div class="col-8"><strong>Nome da Forma de Pagamento</strong></div>
            <div class="col-4"><strong>Ações</strong></div>
        </div>
    
        <!-- Exemplo de uma linha de forma de pagamento -->
        <div class="row align-items-center py-2 border-bottom">
            <div class="col-8">Cartão de Crédito</div>
            <div class="col-4">
                <!-- Botão para abrir o modal de update -->
                <button class="btn btn-primary btn-sm" onclick="openModal('update', 'Cartão de Crédito')">Editar</button>
                <!-- Botão para abrir o modal de delete -->
                <button class="btn btn-danger btn-sm" onclick="openModal('delete', 'Cartão de Crédito')">Excluir</button>
            </div>
        </div>
    
        <!-- Exemplo de mais uma linha de forma de pagamento -->
        <div class="row align-items-center py-2 border-bottom">
            <div class="col-8">Boleto Bancário</div>
            <div class="col-4">
                <button class="btn btn-primary btn-sm" onclick="openModal('update', 'Boleto Bancário')">Editar</button>
                <button class="btn btn-danger btn-sm" onclick="openModal('delete', 'Boleto Bancário')">Excluir</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Update e Delete -->
<div class="modal fade" id="actionModal" tabindex="-1" aria-labelledby="actionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="actionModalLabel">Ação</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="modalMessage"></p>
                <!-- Formulário para update -->
                <form id="updateForm" class="d-none">
                    <div class="mb-3">
                        <label for="formaPagamento" class="form-label">Nome da Forma de Pagamento</label>
                        <input type="text" class="form-control" id="updateInput" value="">
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                </form>
                <!-- Botão de confirmação para delete -->
                <button id="deleteConfirmBtn" class="btn btn-danger d-none">Confirmar Exclusão</button>
            </div>
        </div>
    </div>
</div>



<script src="../js/grid-forma-pagamento.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php endif; ?>