<?php
session_start();
require './inc/header.php';
require './inc/database.php';

// Display the records in the database table
$sql = "SELECT * FROM phpdata";
$result = $conn->query($sql);

echo '<section class="person-row text-center">';
echo '<table class="table table-striped">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Sobrenome</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Endereço</th>
            <th>CPF</th>
            <th>RG</th>
            <th>Data de Nascimento</th>
            <th>Certificado Rg. Arm.</th>
            <th>Estado Civil</th>
            <th>Empresas</th>
            <th>Modalidade</th>
            <th>Produtos</th>
            <th>Embarcações</th>
            <th>Despachante</th>
            <th>Documentos</th>
            <th>Upload Documentos</th>
        </tr>
    </thead>
    <tbody>';

foreach ($result as $row) {
    $cliente_id = htmlspecialchars($row['id']); // Supondo que o campo 'id' é o identificador do cliente
    echo '<tr>
        <td>' . htmlspecialchars($row['fName']) . '</td>
        <td>' . htmlspecialchars($row['lName']) . '</td>
        <td>' . htmlspecialchars($row['email']) . '</td>
        <td>' . htmlspecialchars($row['telNumber']) . '</td>
        <td>' . htmlspecialchars($row['address']) . '</td>
        <td>' . htmlspecialchars($row['cpf']) . '</td>
        <td>' . htmlspecialchars($row['rg']) . '</td>
        <td>' . htmlspecialchars($row['dob']) . '</td>
        <td>' . htmlspecialchars($row['certificado']) . '</td>
        <td>' . htmlspecialchars($row['estadoCivil']) . '</td>
        <td>' . htmlspecialchars($row['empresa']) . '</td>
        <td>' . htmlspecialchars($row['modalidade']) . '</td>
        <td>' . htmlspecialchars($row['produtos']) . '</td>
        <td>' . htmlspecialchars($row['embarcacoes']) . '</td>
        <td>' . htmlspecialchars($row['despachante']) . '</td>
        <td>
            <a href="listar_documentos.php?cliente_id=' . $cliente_id . '" class="btn btn-info">Ver Documentos</a>
        </td>
        <td>
            <a href="upload_documento.php?cliente_id=' . $cliente_id . '" class="btn btn-primary">Upload Documento</a>
        </td>
    </tr>';
}

echo '</tbody>';
echo '</table>';
echo '<a class="btn btn-dark mt-5 btn-register" href="add-data.php">Cadastrar</a>';
echo '</section>';

require './inc/footer.php';
?>
