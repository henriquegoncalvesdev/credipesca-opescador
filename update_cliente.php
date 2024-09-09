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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fName = $_POST['fName'];
    $lName = $_POST['lName'];
    $email = $_POST['email'];
    $telNumber = $_POST['telNumber'];
    $address = $_POST['address'];
    $cpf = $_POST['cpf'];
    $rg = $_POST['rg'];
    $dob = $_POST['dob'];
    $certificado = $_POST['certificado'];
    $estadoCivil = $_POST['estadoCivil'];
    $empresa = $_POST['empresa'];
    $modalidade = $_POST['modalidade'];
    $produtos = $_POST['produtos'];
    $embarcacoes = $_POST['embarcacoes'];
    $despachante = $_POST['despachante'];

    // Atualizar os dados no banco de dados usando PDO
    $sql = "UPDATE phpdata SET fName = :fName, lName = :lName, email = :email, telNumber = :telNumber, address = :address, cpf = :cpf, rg = :rg, dob = :dob, certificado = :certificado, estadoCivil = :estadoCivil, empresa = :empresa, modalidade = :modalidade, produtos = :produtos, embarcacoes = :embarcacoes, despachante = :despachante WHERE id = :id";
    $stmt = $conn->prepare($sql);
    
    // Bind parameters
    $stmt->bindParam(':fName', $fName);
    $stmt->bindParam(':lName', $lName);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':telNumber', $telNumber);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':cpf', $cpf);
    $stmt->bindParam(':rg', $rg);
    $stmt->bindParam(':dob', $dob);
    $stmt->bindParam(':certificado', $certificado);
    $stmt->bindParam(':estadoCivil', $estadoCivil);
    $stmt->bindParam(':empresa', $empresa);
    $stmt->bindParam(':modalidade', $modalidade);
    $stmt->bindParam(':produtos', $produtos);
    $stmt->bindParam(':embarcacoes', $embarcacoes);
    $stmt->bindParam(':despachante', $despachante);
    $stmt->bindParam(':id', $cliente_id, PDO::PARAM_INT);

    $stmt->execute();

    header('Location: display-user.php');
    exit();
}

$sql = "SELECT * FROM phpdata WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $cliente_id, PDO::PARAM_INT);
$stmt->execute();
$client = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$client) {
    echo 'Cliente não encontrado!';
    exit();
}

?>

<div class="container mt-5">
    <h2>Atualizar Cliente</h2>
    <form method="post">
        <!-- Form fields as before -->
        <!-- Example field -->
        <div class="mb-3">
            <label for="fName" class="form-label">Nome</label>
            <input type="text" class="form-control" id="fName" name="fName" value="<?= htmlspecialchars($client['fName']) ?>" required>
        </div>
        <!-- Repeat for other fields -->
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
</div>

<?php require './inc/footer.php'; ?>
