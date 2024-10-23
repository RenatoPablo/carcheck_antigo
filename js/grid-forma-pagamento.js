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
    container.innerHTML = '';

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
            openModal('update', item.id_forma_pagamento);
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
function openModal(acao, id) {
    const modalAcao = new bootstrap.Modal(document.getElementById('modalAcao'));
    const mensagemModalAcao = document.getElementById('mensagemModalAcao');
    const formUpdate = document.getElementById('formUpdate');
    const btnConfirmarDelete = document.getElementById('btnConfirmarDelete');

    if (acao === 'update') {
        mensagemModalAcao.textContent = 'Editar Item';
        formUpdate.classList.remove('d-none');
        btnConfirmarDelete.classList.add('d-none');
    } else if (acao === 'delete') {
        mensagemModalAcao.textContent = 'Tem certeza que deseja excluir este item?';
        formUpdate.classList.add('d-none');
        btnConfirmarDelete.classList.remove('d-none');
    }

    modalAcao.show();
}

// Carrega os itens ao abrir a página
carregarItens();