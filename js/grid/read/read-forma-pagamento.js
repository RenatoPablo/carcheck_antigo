function carregarItens() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', '../config/forma-pagamento/read.php', true); // Corrigir o caminho conforme necessário
    xhr.onload = function () {
        if (xhr.status === 200) {
            console.log(xhr.responseText); // Verifica a resposta antes de tentar parsear
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

// Função para atualizar a grid com os itens carregados
function atualizarGrid(resultados) {
    const container = document.getElementById('gridResultadoBusca');
    container.innerHTML = ''; // Limpa a grid antes de atualizar

    if (resultados.length > 0) {
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
    } else {
        // Caso não tenha nenhum item
        const noData = document.createElement('div');
        noData.classList.add('text-center', 'py-3');
        noData.textContent = 'Nenhum item encontrado.';
        container.appendChild(noData);
    }
}

// Função para abrir os modais de update ou delete
function openModal(acao, id, nome = null) {
    const modalAcao = new bootstrap.Modal(document.getElementById('modalAcao'));
    const mensagemModalAcao = document.getElementById('mensagemModalAcao');
    const formUpdate = document.getElementById('formUpdate');
    const btnConfirmarDelete = document.getElementById('btnConfirmarDelete');
    const inputIdItem = document.getElementById('inputIdItem');
    const inputUpdateNome = document.getElementById('inputUpdateNome');
    const inputDeleteIdItem = document.getElementById('inputDeleteIdItem');
    const inputDeleteNome = document.getElementById('inputDeleteNome');

    if (acao === 'update') {
        mensagemModalAcao.textContent = 'Editar Item';
        formUpdate.classList.remove('d-none');
        btnConfirmarDelete.classList.add('d-none');
        
        if (inputIdItem) {
            inputIdItem.value = id;
        }
        if (inputUpdateNome && nome) {
            inputUpdateNome.value = nome;
        }

    } else if (acao === 'delete') {
        mensagemModalAcao.textContent = 'Tem certeza que deseja excluir este item?';
        formUpdate.classList.add('d-none');
        btnConfirmarDelete.classList.remove('d-none');
        
        if (inputDeleteIdItem) {
            inputDeleteIdItem.value = id;
        }
        if (inputDeleteNome && nome) {
            inputDeleteNome.value = nome;
        }
    }

    modalAcao.show();
}

document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById("modalCadastro");
    var btnAbrirModal = document.getElementById("btnAbrirModalCadastro");
    var btnFecharModal = document.querySelector(".modal-close");

    if (btnAbrirModal) {
        btnAbrirModal.addEventListener("click", function() {
            modal.style.display = "flex";
        });
    }

    if (btnFecharModal) {
        btnFecharModal.addEventListener("click", function() {
            modal.style.display = "none";
        });
    }

    window.addEventListener("click", function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    });
});

carregarItens();
