// Variáveis para armazenar os itens selecionados
let selectedItemsServico = [];
let selectedItemsProduto = [];

// Função para adicionar o item de serviço à lista temporária
function adicionarItemServico() {
    const input = document.getElementById('estoqueServico');
    const itemValue = input.value;

    if (itemValue !== '') {
        selectedItemsServico.push(itemValue);
        atualizarListaVisualServico();
        input.value = ''; // Limpar o campo após adicionar
    }
}

// Função para atualizar a lista visual de serviços
function atualizarListaVisualServico() {
    const ul = document.getElementById('itemListServico');
    ul.innerHTML = '';

    selectedItemsServico.forEach((item, index) => {
        const li = document.createElement('li');
        li.textContent = item;

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
function adicionarItemProduto() {
    const input = document.getElementById('estoqueProduto');
    const itemValue = input.value;

    if (itemValue !== '') {
        selectedItemsProduto.push(itemValue);
        atualizarListaVisualProduto();
        input.value = ''; // Limpar o campo após adicionar
    }
}

// Função para atualizar a lista visual de produtos
function atualizarListaVisualProduto() {
    const ul = document.getElementById('itemListProduto');
    ul.innerHTML = '';

    selectedItemsProduto.forEach((item, index) => {
        const li = document.createElement('li');
        li.textContent = item;

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

// Evento para adicionar o item ao clicar no botão
document.getElementById('addItemBtnServico').addEventListener('click', adicionarItemServico);
document.getElementById('addItemBtnProduto').addEventListener('click', adicionarItemProduto);

// Funções de sugestão (Exemplo de implementação)
function buscarEstoqueServico() {
    const input = document.getElementById('estoqueServico');
    const sugestoes = document.getElementById('sugestoesServico');
    sugestoes.innerHTML = ''; // Limpa sugestões anteriores

    // Exemplo de array de serviços para simular busca
    const servicos = ['Serviço A', 'Serviço B', 'Serviço C'];

    // Filtra os serviços baseados no valor do input
    const resultados = servicos.filter(servico => servico.toLowerCase().includes(input.value.toLowerCase()));

    resultados.forEach(servico => {
        const li = document.createElement('li');
        li.textContent = servico;
        li.onclick = function() {
            input.value = servico;
            sugestoes.innerHTML = '';
            sugestoes.style.display = 'none';
        };
        sugestoes.appendChild(li);
    });

    sugestoes.style.display = 'block';
}

function buscarEstoqueProduto() {
    const input = document.getElementById('estoqueProduto');
    const sugestoes = document.getElementById('sugestoesProduto');
    sugestoes.innerHTML = ''; // Limpa sugestões anteriores

    // Exemplo de array de produtos para simular busca
    const produtos = ['Produto X', 'Produto Y', 'Produto Z'];

    // Filtra os produtos baseados no valor do input
    const resultados = produtos.filter(produto => produto.toLowerCase().includes(input.value.toLowerCase()));

    resultados.forEach(produto => {
        const li = document.createElement('li');
        li.textContent = produto;
        li.onclick = function() {
            input.value = produto;
            sugestoes.innerHTML = '';
            sugestoes.style.display = 'none';
        };
        sugestoes.appendChild(li);
    });

    sugestoes.style.display = 'block';
}
