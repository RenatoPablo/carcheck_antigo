// Variáveis para armazenar os itens selecionados
let selectedItemsServico = [];
let selectedItemsProduto = [];

// Função para buscar itens de serviço no estoque e exibir sugestões
// Função para buscar itens de serviço no estoque e exibir sugestões
function buscarEstoqueServico() {
    const input = document.getElementById('estoqueServico');
    const sugestoes = document.getElementById('sugestoesServico');
    const query = input.value.trim(); // Obtém o valor do campo de busca

    // Limpa a lista de sugestões e oculta se o campo estiver vazio
    if (query.length === 0) {
        sugestoes.innerHTML = '';
        sugestoes.style.display = 'none';
        return;
    }

    // Requisição AJAX para buscar serviços no banco de dados
    const xhr = new XMLHttpRequest();
    xhr.open('GET', '../config/busca-estoque.php?query=' + encodeURIComponent(query) + '&tipo=1', true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            const resultados = JSON.parse(xhr.responseText);
            sugestoes.innerHTML = '';

            if (resultados.length === 0) {
                sugestoes.style.display = 'none';
            } else {
                resultados.forEach(servico => {
                    const li = document.createElement('li');
                    li.textContent = servico.nome_servico_produto;
                    li.onclick = function () {
                        input.value = servico.nome_servico_produto;
                        sugestoes.innerHTML = '';
                        sugestoes.style.display = 'none';
                        
                        document.getElementById('addItemBtnServico').style.display = 'inline';
                    };
                    sugestoes.appendChild(li);
                });
                sugestoes.style.display = 'block';
            }
        } else {
            console.error('Erro ao buscar serviços: ' + xhr.status);
        }
    };
    xhr.send();
}

// Função para buscar itens de produto no estoque e exibir sugestões
function buscarEstoqueProduto() {
    const input = document.getElementById('estoqueProduto');
    const sugestoes = document.getElementById('sugestoesProduto');
    const query = input.value.trim(); // Obtém o valor do campo de busca

    // Limpa a lista de sugestões e oculta se o campo estiver vazio
    if (query.length === 0) {
        sugestoes.innerHTML = '';
        sugestoes.style.display = 'none';
        return;
    }

    // Requisição AJAX para buscar produtos no banco de dados
    const xhr = new XMLHttpRequest();
    xhr.open('GET', '../config/busca-estoque.php?query=' + encodeURIComponent(query) + '&tipo=2', true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            const resultados = JSON.parse(xhr.responseText);
            sugestoes.innerHTML = '';

            if (resultados.length === 0) {
                sugestoes.style.display = 'none';
            } else {
                resultados.forEach(produto => {
                    const li = document.createElement('li');
                    li.textContent = produto.nome_servico_produto;
                    li.onclick = function () {
                        input.value = produto.nome_servico_produto;
                        sugestoes.innerHTML = '';
                        sugestoes.style.display = 'none';
                        document.getElementById('quantidadeProduto').style.display = 'inline';
                        document.getElementById('addItemBtnProduto').style.display = 'inline';
                    };
                    sugestoes.appendChild(li);
                });
                sugestoes.style.display = 'block';
            }
        } else {
            console.error('Erro ao buscar produtos: ' + xhr.status);
        }
    };
    xhr.send();
}


// Função para adicionar o item de serviço à lista temporária (sem campo de quantidade)
function adicionarItemServico(event) {
    event.preventDefault(); // Previne o comportamento padrão do botão

    const input = document.getElementById('estoqueServico');
    const itemValue = input.value;

    if (itemValue !== '') {
        selectedItemsServico.push({ item: itemValue }); // Adiciona apenas o nome do serviço
        atualizarListaVisualServico();
        input.value = ''; // Limpa o campo após adicionar
        document.getElementById('addItemBtnServico').style.display = 'none'; // Oculta o botão de adicionar
    }
}

// Função para atualizar a lista visual de serviços
function atualizarListaVisualServico() {
    const ul = document.getElementById('itemListServico');
    ul.innerHTML = '';

    selectedItemsServico.forEach((item, index) => {
        const li = document.createElement('li');
        li.textContent = `${item.item}`; // Exibe apenas o nome do serviço

        const removeBtn = document.createElement('button');
        removeBtn.textContent = 'Remover';
        removeBtn.onclick = function() {
            removerItemServico(index);
        };

        li.appendChild(removeBtn);
        ul.appendChild(li);
    });

    document.getElementById('hiddenItemListServico').value = JSON.stringify(selectedItemsServico);
}

// Função para remover um item da lista de serviços
function removerItemServico(index) {
    selectedItemsServico.splice(index, 1);
    atualizarListaVisualServico();
}




// Função para adicionar o item de produto à lista temporária
function adicionarItemProduto(event) {
    event.preventDefault(); // Previne o comportamento padrão do botão

    const input = document.getElementById('estoqueProduto');
    const quantidadeInput = document.getElementById('quantidadeProduto');
    const itemValue = input.value;
    const quantidade = quantidadeInput.value;

    if (itemValue !== '' && quantidade !== '') {
        selectedItemsProduto.push({ item: itemValue, quantidade: quantidade });
        atualizarListaVisualProduto();
        input.value = ''; // Limpa o campo após adicionar
        quantidadeInput.value = ''; // Limpa o campo de quantidade
        quantidadeInput.style.display = 'none'; // Oculta o campo de quantidade
        document.getElementById('addItemBtnProduto').style.display = 'none'; // Oculta o botão de adicionar
    }
}

// Função para atualizar a lista visual de produtos
function atualizarListaVisualProduto() {
    const ul = document.getElementById('itemListProduto');
    ul.innerHTML = '';

    selectedItemsProduto.forEach((item, index) => {
        const li = document.createElement('li');
        li.textContent = `${item.item} - Quantidade: ${item.quantidade}`;

        const removeBtn = document.createElement('button');
        removeBtn.textContent = 'Remover';
        removeBtn.onclick = function() {
            removerItemProduto(index);
        };

        li.appendChild(removeBtn);
        ul.appendChild(li);
    });

    document.getElementById('hiddenItemListProduto').value = JSON.stringify(selectedItemsProduto);
}

// Função para remover um item da lista de produtos
function removerItemProduto(index) {
    selectedItemsProduto.splice(index, 1);
    atualizarListaVisualProduto();
}

// Adicionar eventos de clique aos botões
document.getElementById('addItemBtnServico').addEventListener('click', adicionarItemServico);
document.getElementById('addItemBtnProduto').addEventListener('click', adicionarItemProduto);
