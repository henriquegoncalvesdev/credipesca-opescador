<?php
session_start();
require './inc/header.php';
require './inc/database.php';

// Verificação de autenticação antes de mostrar os dados
if (!isset($_SESSION['user_id']) || (time() > $_SESSION['timeout'])) {
    session_unset(); 
    session_destroy();
    header('location: login.php');
}

// Exibir os registros na tabela do banco de dados
$sql = "SELECT * FROM phpdata";
$result = $conn->query($sql);

echo '<section class="accordion" id="userAccordion">';

foreach ($result as $row) {
    $cliente_id = htmlspecialchars($row['id']);
    $headingId = 'heading' . $cliente_id;
    $collapseId = 'collapse' . $cliente_id;

    echo '<div class="accordion-item mb-3">'; // Adicionando espaçamento entre itens
    echo '<h2 class="accordion-header" id="' . $headingId . '">';
    echo '<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#' . $collapseId . '" aria-expanded="false" aria-controls="' . $collapseId . '">';
    echo htmlspecialchars($row['fName']) . ' ' . htmlspecialchars($row['lName']);
    echo '</button>';
    echo '</h2>';
    echo '<div id="' . $collapseId . '" class="accordion-collapse collapse" aria-labelledby="' . $headingId . '" data-bs-parent="#userAccordion">';
    echo '<div class="accordion-body p-4">'; // Adicionando padding
    echo '<p><strong>Nome:</strong> ' . htmlspecialchars($row['fName']) . '</p>';
    echo '<p><strong>Sobrenome:</strong> ' . htmlspecialchars($row['lName']) . '</p>';
    echo '<p><strong>Email:</strong> ' . htmlspecialchars($row['email']) . '</p>';
    echo '<p><strong>Telefone:</strong> ' . htmlspecialchars($row['telNumber']) . '</p>';
    echo '<p><strong>Endereço:</strong> ' . htmlspecialchars($row['address']) . '</p>';
    echo '<p><strong>CPF:</strong> ' . htmlspecialchars($row['cpf']) . '</p>';
    echo '<p><strong>RG:</strong> ' . htmlspecialchars($row['rg']) . '</p>';
    echo '<p><strong>Data de Nascimento:</strong> ' . htmlspecialchars($row['dob']) . '</p>';
    echo '<p><strong>Certificado Rg. Arm.:</strong> ' . htmlspecialchars($row['certificado']) . '</p>';
    echo '<p><strong>Estado Civil:</strong> ' . htmlspecialchars($row['estadoCivil']) . '</p>';
    echo '<p><strong>Empresas:</strong> ' . htmlspecialchars($row['empresa']) . '</p>';
    echo '<p><strong>Modalidade:</strong> ' . htmlspecialchars($row['modalidade']) . '</p>';
    echo '<p><strong>Produtos:</strong> ' . htmlspecialchars($row['produtos']) . '</p>';
    echo '<p><strong>Embarcações:</strong> ' . htmlspecialchars($row['embarcacoes']) . '</p>';
    echo '<p><strong>Despachante:</strong> ' . htmlspecialchars($row['despachante']) . '</p>';
    
    echo '<a href="listar_documentos.php?cliente_id=' . $cliente_id . '" class="btn btn-info me-2">Ver Documentos</a>'; // Ver documentos
    echo '<a href="upload_documento.php?cliente_id=' . $cliente_id . '" class="btn btn-primary me-2">Upload Documento</a>'; // Upload documento
    
    // Botões "Atualizar" e "Deletar"
    echo '<a href="update_cliente.php?cliente_id=' . $cliente_id . '" class="btn btn-warning me-2">Atualizar</a>'; // Botão Atualizar
    echo '<a href="delete_cliente.php?cliente_id=' . $cliente_id . '" class="btn btn-danger" onclick="return confirm(\'Tem certeza que deseja excluir este cliente?\')">Deletar</a>'; // Botão Deletar
    
    echo '</div>';
    echo '</div>';
    echo '</div>';
}

echo '</section>';
echo '<a class="btn btn-dark mt-5 btn-register" href="add-data.php">Cadastrar</a>';

require './inc/footer.php';
?>