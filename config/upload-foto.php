<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header("location: ../pages/login.php");
    exit();
}

// Conexão com o banco de dados
require '../config/config.php';

// Verifique se o ID da pessoa está definido na sessão
if (!isset($_SESSION['id_pessoa'])) {
    echo "ID da pessoa não está definido na sessão.";
    exit();
}

// Obtém o ID da pessoa a partir da sessão
$id_pessoa = $_SESSION['id_pessoa'];  // Certifique-se de que o ID da pessoa está na sessão

// Verifica se o arquivo foi enviado corretamente
if (isset($_FILES['fotoPerfil']) && $_FILES['fotoPerfil']['error'] === UPLOAD_ERR_OK) {

    // Parâmetros do arquivo enviado
    $fileTmpPath = $_FILES['fotoPerfil']['tmp_name'];  // Caminho temporário do arquivo
    $fileName = $_FILES['fotoPerfil']['name'];         // Nome original do arquivo
    $fileSize = $_FILES['fotoPerfil']['size'];         // Tamanho do arquivo
    $fileType = $_FILES['fotoPerfil']['type'];         // Tipo MIME do arquivo
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION)); // Extensão do arquivo

    // Definir diretório de destino
    $uploadDir = '../image/';  // Certifique-se de que essa pasta tem permissão de escrita no servidor

    // Gera um nome único para o arquivo
    $newFileName = uniqid() . '.' . $fileExtension;

    // Definir o caminho completo para o arquivo
    $uploadFilePath = $uploadDir . $newFileName;

    // Verifica se a extensão do arquivo é permitida
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    if (in_array($fileExtension, $allowedExtensions)) {

        // Verifica o tamanho do arquivo (exemplo: max 5MB)
        if ($fileSize < 5 * 1024 * 1024) {

            // Move o arquivo para o diretório de destino
            if (move_uploaded_file($fileTmpPath, $uploadFilePath)) {

                // Atualiza o caminho da foto no banco de dados
                $sql = "UPDATE pessoas SET foto = :foto WHERE id_pessoa = :id_pessoa";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':foto', $uploadFilePath);
                $stmt->bindParam(':id_pessoa', $id_pessoa, PDO::PARAM_INT);

                if ($stmt->execute()) {
                    echo "Imagem atualizada com sucesso!";
                    header("location: ../pages/perfil.php");
                } else {
                    echo "Erro ao atualizar a imagem no banco de dados.";
                }

            } else {
                echo "Erro ao mover o arquivo para o diretório de destino.";
            }

        } else {
            echo "O arquivo é muito grande. O limite é de 5MB.";
        }

    } else {
        echo "Tipo de arquivo não permitido. Apenas JPG, JPEG, PNG e GIF são aceitos.";
    }

} else {
    echo "Nenhum arquivo foi enviado ou ocorreu um erro no upload.";
}
var_dump($id_pessoa);
var_dump($_SESSION['id_pessoa']);
?>
