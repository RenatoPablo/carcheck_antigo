// Função para buscar os itens de estoque no banco de dados com AJAX
function buscarEstoque() {
    const input = document.getElementById('estoque'); // Campo de busca
    const sugestoes = document.getElementById('sugestoes'); // Elemento para sugestões
    const query = input.value.trim(); // Valor do campo de busca

    // Obtém o valor do radio selecionado (1 para Serviço ou 2 para Produto)
    const tipoCheckbox = document.querySelector('input[name="tipo"]:checked');
    const tipo = tipoCheckbox ? tipoCheckbox.value : ''; // Se houver radio marcado, pega o valor

    // Se o campo de busca estiver vazio, limpa e oculta a lista de sugestões
    if (query.length === 0) {
        sugestoes.innerHTML = '';
        sugestoes.style.display = 'none'; // Ocultar sugestões
        return;
    }

    // Verifica se o tipo foi selecionado (Serviço ou Produto)
    if (!tipo) {
        alert('Por favor, selecione o tipo: Serviço ou Produto.');
        return;
    }

    // Fazer a requisição AJAX para buscar itens de estoque
    const xhr = new XMLHttpRequest();
    xhr.open('GET', '../config/crud-estoque/read.php?query=' + encodeURIComponent(query) + '&tipo=' + encodeURIComponent(tipo), true);

    xhr.onload = function() {
        if (xhr.status === 200) {
            const itens = JSON.parse(xhr.responseText); // Parseia o JSON retornado pelo servidor
            sugestoes.innerHTML = ''; // Limpa a lista de sugestões

            // Se não houver sugestões, oculta a lista
            if (itens.length === 0) {
                sugestoes.style.display = 'none';
            } else {
                sugestoes.style.display = 'block'; // Mostra sugestões

                // Limitar a lista a no máximo 10 itens
                const maxItens = Math.min(itens.length, 10);
                for (let i = 0; i < maxItens; i++) {
                    const item = itens[i];
                    const li = document.createElement('li');

                    // Adiciona uma classe à <li> para estilização
                    li.classList.add('sugestao-item');

                    // Texto principal do item (nome e valor)
                    const itemName = document.createElement('span');
                    itemName.textContent = `${item.nome_servico_produto} - Valor: ${item.valor_servico_produto}`;
                    li.appendChild(itemName);

                    // Verifica se o tipo é Produto (2) para exibir a quantidade
                    if (tipo === '2') {
                        const quantidadeText = document.createElement('span');
                        quantidadeText.textContent = ` - Quantidade: ${item.quantidade}`;
                        li.appendChild(quantidadeText); // Exibe a quantidade apenas para produtos
                    }

                    // Cria um botão para abrir o modal
                    const btn = document.createElement('button');
                    btn.textContent = 'Editar';
                    btn.classList.add('btn-modal');
                    btn.onclick = function() {
                        openModal(item, tipo); // Passa o item e o tipo para a função openModal
                    };
                    li.appendChild(btn);

                    // Adiciona o item na lista de sugestões
                    sugestoes.appendChild(li);
                }
                sugestoes.classList.add('sugestoes-lista');
            }
        } else {
            console.error('Erro ao buscar estoque:', xhr.status);
        }
    };

    // Envia a requisição AJAX
    xhr.send();
}

// Função para abrir o modal com detalhes do item
function openModal(item, tipo) {
    if (tipo === '2') {
        // Abrir o modal de produto
        const modal = document.getElementById('productModal'); // Obtém o modal de produto
        const id = document.getElementById('id_produto'); // Input escondido para armazenar o ID
        const nome = document.getElementById('nome_produto'); // Input do nome
        const descricao = document.getElementById('descricao_produto'); // Input da descrição
        const valor = document.getElementById('valor_produto'); // Input do valor
        const quantidade = document.getElementById('quantidade_produto'); // Input da quantidade

        // Preenche os campos com os dados do item
        id.value = item.id_servico_produto;
        nome.value = item.nome_servico_produto;
        descricao.value = item.descricao;
        valor.value = item.valor_servico_produto;
        quantidade.value = item.quantidade || '';

        // Exibe o modal
        modal.style.display = 'block';
    } else if (tipo === '1') {
        // Abrir o modal de serviço
        const modal = document.getElementById('serviceModal'); // Obtém o modal de serviço
        const id = document.getElementById('id_servico'); // Input escondido para armazenar o ID
        const nome = document.getElementById('nome_servico'); // Input do nome
        const descricao = document.getElementById('descricao_servico'); // Input da descrição
        const valor = document.getElementById('valor_servico'); // Input do valor

        // Preenche os campos com os dados do item
        id.value = item.id_servico_produto;
        nome.value = item.nome_servico_produto;
        descricao.value = item.descricao;
        valor.value = item.valor_servico_produto;

        // Exibe o modal
        modal.style.display = 'block';
    }
}

// Função para fechar os modais ao clicar no botão de fechar
document.querySelectorAll('.close').forEach(closeBtn => {
    closeBtn.onclick = function() {
        document.getElementById('productModal').style.display = 'none';
        document.getElementById('serviceModal').style.display = 'none';
    };
});

// Fecha o modal ao clicar fora da área de conteúdo
window.onclick = function(event) {
    const productModal = document.getElementById('productModal');
    const serviceModal = document.getElementById('serviceModal');
    if (event.target === productModal) {
        productModal.style.display = 'none';
    }
    if (event.target === serviceModal) {
        serviceModal.style.display = 'none';
    }
};

// Função para salvar as alterações do produto via AJAX
document.getElementById('saveProductChangesBtn').onclick = function() {
    const id = document.getElementById('id_produto').value;
    const nome = document.getElementById('nome_produto').value;
    const descricao = document.getElementById('descricao_produto').value;
    const valor = document.getElementById('valor_produto').value;
    const quantidade = document.getElementById('quantidade_produto').value;

    const xhr = new XMLHttpRequest();
    xhr.open('POST', '../config/crud-estoque/update.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status === 200) {
            alert('Alterações salvas com sucesso!');
            document.getElementById('productModal').style.display = 'none'; // Fecha o modal
            buscarEstoque(); // Atualiza a lista de itens após salvar
        } else {
            alert('Erro ao salvar as alterações.');
        }
    };

    const data = `id_servico_produto=${id}&nome=${encodeURIComponent(nome)}&descricao=${encodeURIComponent(descricao)}&valor=${encodeURIComponent(valor)}&quantidade=${encodeURIComponent(quantidade)}`;
    xhr.send(data);
};

// Função para salvar as alterações do serviço via AJAX
document.getElementById('saveServiceChangesBtn').onclick = function() {
    const id = document.getElementById('id_servico').value;
    const nome = document.getElementById('nome_servico').value;
    const descricao = document.getElementById('descricao_servico').value;
    const valor = document.getElementById('valor_servico').value;

    const xhr = new XMLHttpRequest();
    xhr.open('POST', '../config/crud-estoque/update.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status === 200) {
            alert('Alterações salvas com sucesso!');
            document.getElementById('serviceModal').style.display = 'none'; // Fecha o modal
            buscarEstoque(); // Atualiza a lista de itens após salvar
        } else {
            alert('Erro ao salvar as alterações.');
        }
    };

    const data = `id_servico_produto=${id}&nome=${encodeURIComponent(nome)}&descricao=${encodeURIComponent(descricao)}&valor=${encodeURIComponent(valor)}`;
    xhr.send(data);
};

// Função para excluir o produto via AJAX
document.getElementById('deleteProductBtn').onclick = function() {
    const id = document.getElementById('id_produto').value;

    if (confirm('Tem certeza que deseja excluir este produto?')) {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', '../config/crud-estoque/delete.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                alert('Produto excluído com sucesso!');
                document.getElementById('productModal').style.display = 'none'; // Fecha o modal
                buscarEstoque(); // Atualiza a lista de itens após exclusão
            } else {
                alert('Erro ao excluir o produto.');
            }
        };

        const data = `id_servico_produto=${id}`;
        xhr.send(data);
    }
};

// Função para excluir o serviço via AJAX
document.getElementById('deleteServiceBtn').onclick = function() {
    const id = document.getElementById('id_servico').value;

    if (confirm('Tem certeza que deseja excluir este serviço?')) {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', '../config/crud-estoque/delete.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                alert('Serviço excluído com sucesso!');
                document.getElementById('serviceModal').style.display = 'none'; // Fecha o modal
                buscarEstoque(); // Atualiza a lista de itens após exclusão
            } else {
                alert('Erro ao excluir o serviço.');
            }
        };

        const data = `id_servico_produto=${id}`;
        xhr.send(data);
    }
};
