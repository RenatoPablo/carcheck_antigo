
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

            // Remove qualquer coisa que não seja número
            rg = rg.replace(/\D/g, "");

            // Adiciona pontos e traço
            rg = rg.replace(/(\d{2})(\d)/, "$1.$2");
            rg = rg.replace(/(\d{3})(\d)/, "$1.$2");
            rg = rg.replace(/(\d{3})(\d{1})$/, "$1-$2");

            input.value = rg;
        }
