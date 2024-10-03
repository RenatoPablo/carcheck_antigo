<?php 
    

require '../config/config.php';

function cadastrarFormaPagamento($pdo, $tipo_pagamento){
    $sql = "SELECT id_forma_pagamento INTO formas_pagamento WHERE tipo_pagamento = :tipo";
    $stmtCheck = $pdo->prepare($sql);
    $stmtCheck->execute([':tipo' => $tipo_pagamento]);

    if ($stmtCheck->rowCount() > 0) {
        $tipo = $stmtCheck->fetch(PDO::FETCH_ASSOC);
        return $tipo['id_forma_pagamento'];
    }

    $sqlInsert = "INSERT INTO formas_pagamento(tipo_pagamento) VALUES (:tipo)";
    $stmtInsert = $pdo->prepare($sqlInsert);
    $stmtInsert->execute([':tipo' => $tipo_pagamento]);

    return $pdo->lastInsertId();
}

function cadastrarPagamento($pdo, $valorPagamento, $idFormaPagamento) {
    $sql = "INSERT INTO pagamentos(valor_pagamento, fk_id_forma_pagamento) VALUES (:valor, :idForma)";
    $stmtInsert = $pdo->prepare($sql);
    $stmtInsert->execute([':valor' => $valorPagamento,
                          ':idForma' => $idFormaPagamento]);
    return $pdo->lastInsertId();
}
?>