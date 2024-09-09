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
        <div class="mb-3">
            <label for="fName" class="form-label">Nome</label>
            <input type="text" class="form-control" id="fName" name="fName" value="<?= htmlspecialchars($client['fName']) ?>">
        </div>
        <div class="mb-3">
            <label for="lName" class="form-label">Sobrenome</label>
            <input type="text" class="form-control" id="lName" name="lName" value="<?= htmlspecialchars($client['lName']) ?>">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($client['email']) ?>">
        </div>
        <div class="mb-3">
            <label for="telNumber" class="form-label">Telefone</label>
            <input type="text" class="form-control" id="telNumber" name="telNumber" value="<?= htmlspecialchars($client['telNumber']) ?>">
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Endereço</label>
            <input type="text" class="form-control" id="address" name="address" value="<?= htmlspecialchars($client['address']) ?>">
        </div>
        <div class="mb-3">
            <label for="cpf" class="form-label">CPF</label>
            <input type="text" class="form-control" id="cpf" name="cpf" value="<?= htmlspecialchars($client['cpf']) ?>">
        </div>
        <div class="mb-3">
            <label for="rg" class="form-label">RG</label>
            <input type="text" class="form-control" id="rg" name="rg" value="<?= htmlspecialchars($client['rg']) ?>">
        </div>
        <div class="mb-3">
            <label for="dob" class="form-label">Data de Nascimento</label>
            <input type="date" class="form-control" id="dob" name="dob" value="<?= htmlspecialchars($client['dob']) ?>">
        </div>
        <div class="mb-3">
            <label for="certificado" class="form-label">Certificado Rg. Arm.</label>
            <input type="text" class="form-control" id="certificado" name="certificado" value="<?= htmlspecialchars($client['certificado']) ?>">
        </div>
        <div class="mb-3">
            <label for="estadoCivil" class="form-label">Estado Civil</label>
            <input type="text" class="form-control" id="estadoCivil" name="estadoCivil" value="<?= htmlspecialchars($client['estadoCivil']) ?>">
        </div>
        <div class="mb-3">
            <label for="empresa" class="form-label">Empresas</label>
            <input type="text" class="form-control" id="empresa" name="empresa" value="<?= htmlspecialchars($client['empresa']) ?>">
        </div>
        <div class="mb-3">
            <label for="modalidade" class="form-label">Modalidade</label>
            <input type="text" class="form-control" id="modalidade" name="modalidade" value="<?= htmlspecialchars($client['modalidade']) ?>">
        </div>
        <div class="mb-3">
            <label for="produtos" class="form-label">Produtos</label>
            <input type="text" class="form-control" id="produtos" name="produtos" value="<?= htmlspecialchars($client['produtos']) ?>">
        </div>
        <div class="mb-3">
            <label for="embarcacoes" class="form-label">Embarcações</label>
            <input type="text" class="form-control" id="embarcacoes" name="embarcacoes" value="<?= htmlspecialchars($client['embarcacoes']) ?>">
        </div>
        <div class="mb-3">
            <label for="despachante" class="form-label">Despachante</label>
            <input type="text" class="form-control" id="despachante" name="despachante" value="<?= htmlspecialchars($client['despachante']) ?>">
        </div>
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
</div>

<?php require './inc/footer.php'; ?>
