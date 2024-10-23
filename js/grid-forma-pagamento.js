// Função para buscar os itens no banco e exibi-los na grid
function carregarItens() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', '../config/forma-pagamento/read.php', true); // Corrigir o caminho conforme necessário
    xhr.onload = function () {
        if (xhr.status === 200) {
            try {
                const resultados = JSON.parse(xhr.responseText);
                atualizarGrid(resultados); // Exibe todos os resultados na grid
            } catch (error) {
                console.error("Erro ao processar os dados:", error);
            }
        } else {
            console.error("Erro na requisição: " + xhr.status);
        }
    };
    xhr.send();
}

// Função para filtrar a grid com base no valor digitado
document.getElementById('inputBusca').addEventListener('keyup', function () {
    const valorBusca = this.value.toLowerCase();
    const linhas = document.querySelectorAll('#gridResultadoBusca .row');

    linhas.forEach(function (linha) {
        const textoLinha = linha.querySelector('.col-8').textContent.toLowerCase();
        if (textoLinha.includes(valorBusca)) {
            linha.style.display = '';
        } else {
            linha.style.display = 'none';
        }
    });
});

// Função para atualizar a grid
function atualizarGrid(resultados) {
    const container = document.getElementById('gridResultadoBusca');
    container.innerHTML = ''; // Limpa a grid antes de atualizar

    resultados.forEach(item => {
        const row = document.createElement('div');
        row.classList.add('row', 'align-items-center', 'py-2', 'border-bottom');

        const nomeColuna = document.createElement('div');
        nomeColuna.classList.add('col-8');
        nomeColuna.textContent = item.tipo_pagamento; // Exibe o nome do pagamento
        row.appendChild(nomeColuna);

        const acoesColuna = document.createElement('div');
        acoesColuna.classList.add('col-4');

        const editarBtn = document.createElement('button');
        editarBtn.classList.add('btn', 'btn-primary', 'btn-sm');
        editarBtn.textContent = 'Editar';
        editarBtn.onclick = function () {
            openModal('update', item.id_forma_pagamento, item.tipo_pagamento); // Passando também o nome para o modal
        };
        acoesColuna.appendChild(editarBtn);

        const excluirBtn = document.createElement('button');
        excluirBtn.classList.add('btn', 'btn-danger', 'btn-sm');
        excluirBtn.textContent = 'Excluir';
        excluirBtn.onclick = function () {
            openModal('delete', item.id_forma_pagamento);
        };
        acoesColuna.appendChild(excluirBtn);

        row.appendChild(acoesColuna);
        container.appendChild(row);
    });
}

// Função para abrir os modais de update ou delete
function openModal(acao, id, nome = null) {
    const modalAcao = new bootstrap.Modal(document.getElementById('modalAcao'));
    const mensagemModalAcao = document.getElementById('mensagemModalAcao');
    const formUpdate = document.getElementById('formUpdate');
    const btnConfirmarDelete = document.getElementById('btnConfirmarDelete');
    const inputIdItem = document.getElementById('inputIdItem');
    const inputUpdateNome = document.getElementById('inputUpdateNome');

    if (acao === 'update') {
        mensagemModalAcao.textContent = 'Editar Item';
        formUpdate.classList.remove('d-none');
        btnConfirmarDelete.classList.add('d-none');
        
        // Definir o ID no campo hidden
        if (inputIdItem) {
            inputIdItem.value = id;
        }

        // Preencher o campo de nome diretamente
        if (inputUpdateNome && nome) {
            inputUpdateNome.value = nome;
        }

    } else if (acao === 'delete') {
        mensagemModalAcao.textContent = 'Tem certeza que deseja excluir este item?';
        formUpdate.classList.add('d-none');
        btnConfirmarDelete.classList.remove('d-none');
    }

    modalAcao.show();
}
document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById("modalCadastro");
    var btnAbrirModal = document.getElementById("btnAbrirModalCadastro");
    var btnFecharModal = document.querySelector(".modal-close");

    // Verifica se os elementos existem antes de adicionar os eventos
    if (btnAbrirModal) {
        // Abrir o modal ao clicar no botão "Cadastrar Novo Item"
        btnAbrirModal.addEventListener("click", function() {
            modal.style.display = "flex"; // Mostrar o modal ao clicar no botão
        });
    }

    if (btnFecharModal) {
        // Fechar o modal ao clicar no botão "X"
        btnFecharModal.addEventListener("click", function() {
            modal.style.display = "none"; // Esconder o modal ao clicar no "X"
        });
    }

    // Fechar o modal ao clicar fora da área de conteúdo
    window.addEventListener("click", function(event) {
        if (event.target == modal) {
            modal.style.display = "none"; // Esconde o modal se clicar fora dele
        }
    });
});


// Carrega os itens ao abrir a página
carregarItens();
