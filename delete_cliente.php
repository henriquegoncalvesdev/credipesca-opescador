<?php
session_start();
require './inc/header.php';
require './inc/database.php';

// Verificação de autenticação antes de mostrar os dados
if (!isset($_SESSION['user_id']) || (time() > $_SESSION['timeout'])) {
    session_unset(); 
    session_destroy();
    header('location: login.php');
    exit();
}

$cliente_id = isset($_GET['cliente_id']) ? intval($_GET['cliente_id']) : 0;

if ($cliente_id > 0) {
    // Excluir o cliente do banco de dados usando PDO
    $sql = "DELETE FROM phpdata WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $cliente_id, PDO::PARAM_INT);
    $stmt->execute();

    header('Location: display-user.php');
    exit();
} else {
    echo 'ID do cliente inválido!';
}

require './inc/footer.php';
