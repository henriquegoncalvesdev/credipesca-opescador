<?php
require './inc/header.php';
require './inc/database.php';

// Verifica se o cliente_id foi passado via GET
if (isset($_GET['cliente_id'])) {
    $cliente_id = $_GET['cliente_id'];

    // Consulta para buscar documentos do cliente
    $sqlDocumentos = "SELECT * FROM documentos WHERE cliente_id = :cliente_id";
    $stmtDocumentos = $conn->prepare($sqlDocumentos);
    $stmtDocumentos->bindParam(':cliente_id', $cliente_id);
    $stmtDocumentos->execute();
    $documentos = $stmtDocumentos->fetchAll(PDO::FETCH_ASSOC);

    // Exibe os documentos, com previews para imagens
    echo '<section class="container mt-5">';
    echo '<h2>Documentos para Cliente ID ' . htmlspecialchars($cliente_id) . '</h2>';
    echo '<div class="row">';

    if ($documentos) {
        foreach ($documentos as $documento) {
            $caminho_arquivo = htmlspecialchars($documento['caminho_arquivo']);
            $nome_arquivo = htmlspecialchars($documento['nome_arquivo']);
            
            // Verifica se o arquivo é uma imagem
            $extensao = pathinfo($caminho_arquivo, PATHINFO_EXTENSION);
            $isImage = in_array($extensao, ['jpg', 'jpeg', 'png', 'gif']);

            echo '<div class="col-md-4 mb-3">';
            echo '<div class="card">';
            if ($isImage) {
                echo '<img src="' . $caminho_arquivo . '" class="card-img-top" alt="' . $nome_arquivo . '" style="width: 100%; height: auto;">';
            } else {
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . $nome_arquivo . '</h5>';
                echo '<p class="card-text"><a href="' . $caminho_arquivo . '" class="btn btn-primary" download>Download</a></p>';
                echo '</div>';
            }
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo '<p>Nenhum documento encontrado para este cliente.</p>';
    }

    echo '</div>';
    echo '</section>';
} else {
    echo '<p>ID do cliente não foi fornecido.</p>';
}

require './inc/footer.php';
?>
