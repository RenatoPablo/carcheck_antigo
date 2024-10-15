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
                        openModal(item); // Abre o modal com os detalhes do item
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
function openModal(item) {
    const modal = document.getElementById('myModal'); // Obtém o modal pelo ID
    const id = document.getElementById('id_servico_produto'); // Input escondido para armazenar o ID
    const nome = document.getElementById('nome'); // Input do nome
    const descricao = document.getElementById('descricao'); // Input da descrição
    const valor = document.getElementById('valor'); // Input do valor
    const quantidade = document.getElementById('quantidade'); // Input da quantidade (para produtos)

    // Preenche os campos com os dados do item
    id.value = item.id_servico_produto;
    nome.value = item.nome_servico_produto;
    descricao.value = item.descricao;
    valor.value = item.valor_servico_produto;
    quantidade.value = item.quantidade || ''; // Se for um serviço, o campo pode estar vazio

    // Exibe o modal
    modal.style.display = 'block';
}

// Função para fechar o modal ao clicar no botão de fechar
document.querySelector('.close').onclick = function() {
    document.getElementById('myModal').style.display = 'none'; // Fecha o modal
};

// Fecha o modal ao clicar fora da área de conteúdo
window.onclick = function(event) {
    const modal = document.getElementById('myModal');
    if (event.target == modal) {
        modal.style.display = 'none'; // Fecha o modal
    }
};

// Função para salvar as alterações via AJAX
document.getElementById('saveChangesBtn').onclick = function() {
    const id = document.getElementById('id_servico_produto').value;
    const nome = document.getElementById('nome').value;
    const descricao = document.getElementById('descricao').value;
    const valor = document.getElementById('valor').value;
    const quantidade = document.getElementById('quantidade').value;

    const xhr = new XMLHttpRequest();
    xhr.open('POST', '../config/crud-estoque/update.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status === 200) {
            alert('Alterações salvas com sucesso!');
            document.getElementById('myModal').style.display = 'none'; // Fecha o modal
            buscarEstoque(); // Atualiza a lista de itens após salvar
        } else {
            alert('Erro ao salvar as alterações.');
        }
    };

    const data = `id_servico_produto=${id}&nome=${nome}&descricao=${descricao}&valor=${valor}&quantidade=${quantidade}`;
    xhr.send(data);
};

// Função para excluir o item via AJAX
document.getElementById('deleteBtn').onclick = function() {
    const id = document.getElementById('id_servico_produto').value;

    if (confirm('Tem certeza que deseja excluir este item?')) {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', '../config/crud-estoque/delete.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                alert('Item excluído com sucesso!');
                document.getElementById('myModal').style.display = 'none'; // Fecha o modal
                buscarEstoque(); // Atualiza a lista de itens após exclusão
            } else {
                alert('Erro ao excluir o item.');
            }
        };

        const data = `id_servico_produto=${id}`;
        xhr.send(data);
    }
};
