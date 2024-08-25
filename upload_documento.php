<?php
require './inc/header.php';
require './inc/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cliente_id = $_POST['cliente_id'];
    $documentos = $_FILES['documentos'];

    if ($documentos['error'][0] == 0) {
        // Verifica se o diretório de upload existe, senão cria
        if (!is_dir('uploads')) {
            mkdir('uploads', 0777, true);
        }

        // Processa cada arquivo enviado
        foreach ($documentos['name'] as $index => $nome_arquivo) {
            // Caminho onde o arquivo será salvo
            $caminho = 'uploads/' . basename($nome_arquivo);

            // Move o arquivo para o servidor
            if (move_uploaded_file($documentos['tmp_name'][$index], $caminho)) {
                // Insere os dados do documento na base de dados
                $sql = "INSERT INTO documentos (cliente_id, nome_arquivo, caminho_arquivo) VALUES (:cliente_id, :nome_arquivo, :caminho_arquivo)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':cliente_id', $cliente_id);
                $stmt->bindParam(':nome_arquivo', $nome_arquivo);
                $stmt->bindParam(':caminho_arquivo', $caminho);

                if (!$stmt->execute()) {
                    echo "<p>Erro ao salvar o documento no banco de dados: " . $stmt->errorInfo()[2] . "</p>";
                }
            } else {
                echo "<p>Erro ao mover o arquivo para o servidor: $nome_arquivo</p>";
            }
        }
        echo "<p>Documentos enviados com sucesso!</p>";
    } else {
        echo "<p>Erro ao enviar os arquivos.</p>";
    }
    $conn = null;
} else {
    if (isset($_GET['cliente_id'])) {
        $cliente_id = $_GET['cliente_id'];
    } else {
        echo "<p>ID do cliente não foi fornecido.</p>";
        exit;
    }
}
?>

<section class="container mt-5">
    <h2>Upload de Documentos para Cliente ID <?php echo htmlspecialchars($cliente_id); ?></h2>
    <form method="post" action="upload_documento.php" enctype="multipart/form-data">
        <input type="hidden" name="cliente_id" value="<?php echo htmlspecialchars($cliente_id); ?>">
        <div class="form-group">
            <label for="documentos">Escolha os documentos:</label>
            <input type="file" class="form-control" id="documentos" name="documentos[]" multiple required>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Upload</button>
    </form>
</section>

<?php
require './inc/footer.php';
?>
