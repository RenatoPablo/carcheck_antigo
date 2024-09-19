
        function mascaraCPF(input) {
            let cpf = input.value;
            
            // Remove qualquer coisa que não seja número
            cpf = cpf.replace(/\D/g, "");
            
            // Adiciona pontos e traço
            cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2");
            cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2");
            cpf = cpf.replace(/(\d{3})(\d{1,2})$/, "$1-$2");
            
            input.value = cpf;
        }

        function mascaraRG(input) {
            let rg = input.value;
        
            // Remove qualquer coisa que não seja número ou 'X' no final
            rg = rg.replace(/[^0-9Xx]/g, ""); // Permite números e 'X'
        
            // Adiciona pontos e traço
            rg = rg.replace(/(\d{2})(\d)/, "$1.$2");
            rg = rg.replace(/(\d{3})(\d)/, "$1.$2");
            rg = rg.replace(/(\d{3})([\dXx])$/, "$1-$2"); // Permite o último caractere ser 'X'
        
            input.value = rg.toUpperCase(); // Converte o 'x' minúsculo para 'X' maiúsculo, se for o caso
        }
        
        

        function mascaraCNPJ(input) {
            let cnpj = input.value;
        
            // Remove qualquer coisa que não seja número
            cnpj = cnpj.replace(/\D/g, "");
        
            // Adiciona pontos, barra e traço no formato: 00.000.000/0000-00
            cnpj = cnpj.replace(/^(\d{2})(\d)/, "$1.$2");
            cnpj = cnpj.replace(/^(\d{2})\.(\d{3})(\d)/, "$1.$2.$3");
            cnpj = cnpj.replace(/\.(\d{3})(\d)/, ".$1/$2");
            cnpj = cnpj.replace(/(\d{4})(\d{2})$/, "$1-$2");
        
            input.value = cnpj;
        }
        
        function mascaraIE(input) {
            let ie = input.value;
        
            // Remove qualquer coisa que não seja número
            ie = ie.replace(/\D/g, "");
        
            // Adiciona pontos e traço (formato exemplo: 000.000.000.000)
            ie = ie.replace(/(\d{2})(\d)/, "$1.$2");
            ie = ie.replace(/(\d{3})(\d)/, "$1.$2");
            ie = ie.replace(/(\d{3})(\d{1,2})$/, "$1.$2");
        
            input.value = ie;
        }

        function mascaraTelefone(input) {
            let telefone = input.value;
        
            // Remove qualquer caractere que não seja número
            telefone = telefone.replace(/\D/g, "");
        
            // Aplica a máscara para telefone no formato (00) 00000-0000
            telefone = telefone.replace(/^(\d{2})(\d)/, "($1) $2"); // Coloca o DDD entre parênteses
            telefone = telefone.replace(/(\d{5})(\d{4})$/, "$1-$2"); // Coloca o traço no número principal
        
            input.value = telefone;
        }
        
        
        
        