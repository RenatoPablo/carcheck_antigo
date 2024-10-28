function carregarItens() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', '../config/crud-cliente/read.php', true); // URL para carregar dados dos clientes
    xhr.onload = function () {
        if (xhr.status === 200) {
            console.log(xhr.responseText); // Verifica a resposta antes de tentar parsear
            try {
                const resultados = JSON.parse(xhr.responseText);
                console.log(resultados); // Verifica o JSON retornado para garantir que está correto
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

function atualizarGrid(resultados) {
    const container = document.getElementById('gridResultadoBusca');
    container.innerHTML = ''; // Limpa a grid antes de atualizar

    if (resultados.length > 0) {
        resultados.forEach(item => {
            const row = document.createElement('div');
            row.classList.add('row', 'align-items-center', 'py-2', 'border-bottom');

            // Coluna de Nome
            const nomeColuna = document.createElement('div');
            nomeColuna.classList.add('col-3');
            nomeColuna.textContent = item.nome_pessoa;
            row.appendChild(nomeColuna);

            // Coluna de Email
            const emailColuna = document.createElement('div');
            emailColuna.classList.add('col-2');
            emailColuna.textContent = item.endereco_email;
            row.appendChild(emailColuna);

            // Coluna de Telefone
            const telefoneColuna = document.createElement('div');
            telefoneColuna.classList.add('col-2');
            telefoneColuna.textContent = item.numero_telefone;
            row.appendChild(telefoneColuna);

            // Coluna Tipo (Física ou Jurídica) e Documento (CPF ou CNPJ)
            const tipoDocumentoColuna = document.createElement('div');
            tipoDocumentoColuna.classList.add('col-3');
            
            // Verifica se é pessoa física ou jurídica
            if (item.cpf) {
                tipoDocumentoColuna.textContent = `Física - CPF: ${item.cpf}`;
            } else if (item.cnpj) {
                tipoDocumentoColuna.textContent = `Jurídica - CNPJ: ${item.cnpj}`;
            } else {
                tipoDocumentoColuna.textContent = 'Tipo desconhecido';
            }
            
            row.appendChild(tipoDocumentoColuna);

            // Coluna de Ações
            const acoesColuna = document.createElement('div');
            acoesColuna.classList.add('col-2');

            // Botão Editar
            const editarBtn = document.createElement('button');
            editarBtn.classList.add('btn', 'btn-primary', 'btn-sm');
            editarBtn.textContent = 'Editar';

            // Chama o modal de edição com todos os dados
            editarBtn.onclick = function () {
                openModal(
                    'update', 
                    item.id_pessoa, 
                    item.nome_pessoa, 
                    item.endereco_email, 
                    item.numero_telefone, 
                    item.cpf, 
                    item.rg, 
                    item.cnpj, 
                    item.ie, 
                    item.razao_social, 
                    item.nome_fantasia,
                    item.genero, 
                    item.nome_rua, 
                    item.numero_casa, 
                    item.nome_bairro, 
                    item.nome_cidade, 
                    item.numero_cep, 
                    item.desc_complemento, 
                    item.desc_ponto_ref, 
                    
                );
            };

            acoesColuna.appendChild(editarBtn);

            // Botão Excluir
            const excluirBtn = document.createElement('button');
            excluirBtn.classList.add('btn', 'btn-danger', 'btn-sm');
            excluirBtn.textContent = 'Excluir';
            excluirBtn.onclick = function () {
                openModal('delete', item.id_pessoa, item.nome_pessoa);
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





function openModal(acao, id, nome = null, email = null, telefone = null, cpf = null, rg = null, cnpj = null, ie = null, razao_social = null, nome_fantasia = null, genero = null, rua = null, numero_casa = null, bairro = null, cidade = null, cep = null, complemento = null, ponto_referencia = null) {
    const modalAcao = new bootstrap.Modal(document.getElementById('modalAcao')); // Confirma que o modal está correto
    const tituloModal = document.getElementById('modalTituloAcao');
    const mensagemModalAcao = document.getElementById('mensagemModalAcao');
    const modalContent = document.getElementById('modalContent');
    const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');

    // Limpa conteúdo anterior do modal
    modalContent.innerHTML = '';
    confirmDeleteBtn.classList.add('d-none');

    if (acao === 'update') {
        tituloModal.textContent = 'Editar Cliente';
        mensagemModalAcao.textContent = `Editando o cliente: ${nome || ''}`; // Verifica se o nome está preenchido

        // Conteúdo dinâmico para o formulário de edição
        modalContent.innerHTML = `
            <form id="updateForm" action="../config/crud-cliente/update.php" method="POST">
                <input type="hidden" id="updateId" name="id" value="${id || ''}">

                <label for="updateNome">Nome</label>
                <input type="text" id="updateNome" name="nome" class="form-control" value="${nome || ''}">
                
                <label for="updateEmail">Email</label>
                <input type="email" id="updateEmail" name="email" class="form-control" value="${email || ''}">
                
                <label for="updateTelefone">Telefone</label>
                <input type="text" id="updateTelefone" name="telefone" class="form-control" value="${telefone || ''}">
                
                ${cpf ? `
                    <label for="updateCPF">CPF</label>
                    <input type="text" id="updateCPF" name="cpf" class="form-control" value="${cpf || ''}">
                    
                    <label for="updateRG">RG</label>
                    <input type="text" id="updateRG" name="rg" class="form-control" value="${rg || ''}">
                ` : ''}

                ${cnpj ? `
                    <label for="updateCNPJ">CNPJ</label>
                    <input type="text" id="updateCNPJ" name="cnpj" class="form-control" value="${cnpj || ''}">
                    
                    <label for="updateIE">Inscrição Estadual (IE)</label>
                    <input type="text" id="updateIE" name="ie" class="form-control" value="${ie || ''}">
                    
                    <label for="updateRazaoSocial">Razão Social</label>
                    <input type="text" id="updateRazaoSocial" name="razao" class="form-control" value="${razao_social || ''}">
                    
                    <label for="updateNomeFantasia">Nome Fantasia</label>
                    <input type="text" id="updateNomeFantasia" name="fantasia" class="form-control" value="${nome_fantasia || ''}">
                ` : ''}

                

                <label for="updateRua">Rua</label>
                <input type="text" id="updateRua" name="rua" class="form-control" value="${rua || ''}">

                <label for="updateNumeroCasa">Número da Casa</label>
                <input type="text" id="updateNumeroCasa" name="numero" class="form-control" value="${numero_casa || ''}">

                <label for="updateBairro">Bairro</label>
                <input type="text" id="updateBairro" name="bairro" class="form-control" value="${bairro || ''}">

                <label for="updateCidade">Cidade</label>
                <input type="text" id="updateCidade" name="cidade" class="form-control" value="${cidade || ''}">

                <label for="updateCEP">CEP</label>
                <input type="text" id="updateCEP" name="cep" class="form-control" value="${cep || ''}">

                <label for="updateComplemento">Complemento</label>
                <input type="text" id="updateComplemento" name="complemento" class="form-control" value="${complemento || ''}">

                <label for="updatePontoReferencia">Ponto de Referência</label>
                <input type="text" id="updatePontoReferencia" name="referencia" class="form-control" value="${ponto_referencia || ''}">


                <button type="submit" class="btn btn-success">Salvar</button>
            </form>
        `;

    } else if (acao === 'delete') {
        tituloModal.textContent = 'Excluir Cliente';
        mensagemModalAcao.textContent = `Tem certeza que deseja excluir o cliente: ${nome || ''}?`;
        confirmDeleteBtn.classList.remove('d-none');
    }

    modalAcao.show(); // Abre o modal
}









document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById("modalCadastro");
    const btnAbrirModal = document.getElementById("btnAbrirModalCadastro");
    const btnFecharModal = document.querySelector(".modal-close");

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

carregarItens(); // Chama a função para carregar dados ao iniciar a página
