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

// Adicionando uma seção principal para a tabela de clientes
echo '<div class="container mt-5">';
echo '<h2 class="text-center mb-4">Clientes</h2>'; // Título centralizado
echo '<section class="accordion shadow-sm" id="userAccordion">';

foreach ($result as $row) {
    $cliente_id = htmlspecialchars($row['id']);
    $headingId = 'heading' . $cliente_id;
    $collapseId = 'collapse' . $cliente_id;

    echo '<div class="accordion-item mb-3 border-0 shadow-sm">'; // Adicionando uma borda suave e sombra para melhorar o layout
    echo '<h2 class="accordion-header" id="' . $headingId . '">';
    echo '<button class="accordion-button collapsed bg-light text-dark fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#' . $collapseId . '" aria-expanded="false" aria-controls="' . $collapseId . '">';
    echo '<i class="bi bi-person-circle me-2"></i>' . htmlspecialchars($row['fName']) . ' ' . htmlspecialchars($row['lName']);
    echo '</button>';
    echo '</h2>';
    echo '<div id="' . $collapseId . '" class="accordion-collapse collapse" aria-labelledby="' . $headingId . '" data-bs-parent="#userAccordion">';
    echo '<div class="accordion-body bg-white rounded-3 p-4">'; // Background branco e bordas arredondadas

    // Exibir detalhes do cliente em um layout de duas colunas
    echo '<div class="row">';
    
    echo '<div class="col-md-6">';
    echo '<p><strong>Nome:</strong> ' . htmlspecialchars($row['fName']) . '</p>';
    echo '<p><strong>Sobrenome:</strong> ' . htmlspecialchars($row['lName']) . '</p>';
    echo '<p><strong>Email:</strong> ' . htmlspecialchars($row['email']) . '</p>';
    echo '<p><strong>Telefone:</strong> ' . htmlspecialchars($row['telNumber']) . '</p>';
    echo '<p><strong>Endereço:</strong> ' . htmlspecialchars($row['address']) . '</p>';
    echo '</div>';

    echo '<div class="col-md-6">';
    echo '<p><strong>CPF:</strong> ' . htmlspecialchars($row['cpf']) . '</p>';
    echo '<p><strong>RG:</strong> ' . htmlspecialchars($row['rg']) . '</p>';
    echo '<p><strong>Data de Nascimento:</strong> ' . htmlspecialchars($row['dob']) . '</p>';
    echo '<p><strong>Certificado Rg. Arm.:</strong> ' . htmlspecialchars($row['certificado']) . '</p>';
    echo '<p><strong>Estado Civil:</strong> ' . htmlspecialchars($row['estadoCivil']) . '</p>';
    echo '</div>';
    
    echo '<div class="col-md-6">';
    echo '<p><strong>Empresas:</strong> ' . htmlspecialchars($row['empresa']) . '</p>';
    echo '<p><strong>Modalidade:</strong> ' . htmlspecialchars($row['modalidade']) . '</p>';
    echo '<p><strong>Produtos:</strong> ' . htmlspecialchars($row['produtos']) . '</p>';
    echo '</div>';

    echo '<div class="col-md-6">';
    echo '<p><strong>Embarcações:</strong> ' . htmlspecialchars($row['embarcacoes']) . '</p>';
    echo '<p><strong>Despachante:</strong> ' . htmlspecialchars($row['despachante']) . '</p>';
    echo '</div>';
    
    echo '</div>'; // Fim da row
    
    // Botões com um estilo mais refinado
    echo '<div class="d-flex justify-content-end mt-3">';
    echo '<a href="listar_documentos.php?cliente_id=' . $cliente_id . '" class="btn btn-info me-2"><i class="bi bi-file-earmark-text"></i> Ver Documentos</a>'; // Ver documentos
    echo '<a href="upload_documento.php?cliente_id=' . $cliente_id . '" class="btn btn-primary me-2"><i class="bi bi-cloud-upload"></i> Upload Documento</a>'; // Upload documento
    echo '<a href="update_cliente.php?cliente_id=' . $cliente_id . '" class="btn btn-warning me-2"><i class="bi bi-pencil-square"></i> Atualizar</a>'; // Botão Atualizar
    echo '<a href="delete_cliente.php?cliente_id=' . $cliente_id . '" class="btn btn-danger" onclick="return confirm(\'Tem certeza que deseja excluir este cliente?\')"><i class="bi bi-trash"></i> Deletar</a>'; // Botão Deletar
    echo '</div>';
    
    echo '</div>';
    echo '</div>';
}

echo '</section>';
echo '<div class="text-center mt-5">';
echo '<a class="btn btn-dark btn-register" href="add-data.php"><i class="bi bi-person-plus"></i> Cadastrar Novo Cliente</a>';
echo '</div>';
echo '</div>';

require './inc/footer.php';
?>
