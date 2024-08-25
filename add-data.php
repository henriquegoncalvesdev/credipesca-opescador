<?php
//start or resume session
session_start();
//require header and database
require './inc/header.php';
require './inc/database.php';

//check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //get the values from post request
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

    // use try and catch to handle exceptions with database connection
    try {
        //query to insert data into the database
        $sql = "INSERT INTO phpdata (fName, lName, email, telNumber, address, cpf, rg, dob, certificado, estadoCivil, empresa, modalidade, produtos, embarcacoes, despachante) 
        VALUES (:fName, :lName, :email, :telNumber, :address, :cpf, :rg, :dob, :certificado, :estadoCivil, :empresa, :modalidade, :produtos, :embarcacoes, :despachante)";
        $stmt = $conn->prepare($sql);
        //bind parameters to the SQL query
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

        //executes the query
        if ($stmt->execute()) {
            echo "<p>Salvo com sucesso!</p>";
        } else {
            echo "<p>Error: " . $stmt->errorInfo()[2] . "</p>";
        }
    } catch (PDOException $e) {
        //display error message
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
}
?>

<section class="container mt-5 text-center">
    <h2>Cadastrar Cliente:</h2>
    <form method="post" action="add-data.php" class="form-data text-start mt-5">
        <div class="form-group">
            <label for="fName">Nome:</label>
            <input type="text" class="form-control" id="fName" name="fName" required>
        </div>
        <div class="form-group">
            <label for="lName">Sobrenome:</label>
            <input type="text" class="form-control" id="lName" name="lName" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="telNumber">Telefone:</label>
            <input type="text" class="form-control" id="telNumber" name="telNumber" required>
        </div>
        <div class="form-group">
            <label for="address">Endereço:</label>
            <input type="text" class="form-control" id="address" name="address">
        </div>
        <div class="form-group">
            <label for="cpf">CPF:</label>
            <input type="text" class="form-control" id="cpf" name="cpf">
        </div>
        <div class="form-group">
            <label for="rg">RG:</label>
            <input type="text" class="form-control" id="rg" name="rg">
        </div>
        <div class="form-group">
            <label for="dob">Data de Nascimento:</label>
            <input type="date" class="form-control" id="dob" name="dob">
        </div>
        <div class="form-group">
            <label for="certificado">Certificados:</label>
            <input type="text" class="form-control" id="certificado" name="certificado">
        </div>
        <div class="form-group">
            <label for="estadoCivil">Estado Civíl:</label>
            <input type="text" class="form-control" id="estadoCivil" name="estadoCivil">
        </div>
        <div class="form-group">
            <label for="empresa">Empresas:</label>
            <input type="text" class="form-control" id="empresa" name="empresa">
        </div>
        <div class="form-group">
            <label for="modalidade">Medalidade de Pesca:</label>
            <input type="text" class="form-control" id="modalidade" name="modalidade">
        </div>
        <div class="form-group">
            <label for="produtos">Produtos:</label>
            <input type="text" class="form-control" id="produtos" name="produtos">
        </div>
        <div class="form-group">
            <label for="embarcacoes">Embarcações:</label>
            <input type="text" class="form-control" id="embarcacoes" name="embarcacoes">
        </div>
        <div class="form-group">
            <label for="despachante">Despachante:</label>
            <input type="text" class="form-control" id="despachante" name="despachante">
        </div>
        <button type="submit" class="btn btn-dark mt-5 btn-register">Submit</button>
    </form>
</section>

<?php
require './inc/footer.php';
?>
