<?php
  
  include './inc/header.php';
  require "./inc/database.php";

  $uploadSuccess = false; 
  $valid_file=true;

  //check if form is submitted
  if(!empty($_POST)) {
    //count number of files
    $countfiles = count($_FILES['files']['name']);
    //prepare query
    $query = "INSERT INTO imagestest (name,image) 
    VALUES(?,?)";
    $statement = $conn->prepare($query);

    //loop through files
    for($i = 0; $i < $countfiles; $i++) {
      $filename = $_FILES['files']['name'][$i];
      $target_file = './uploads/'.$filename;
      $file_extension = pathinfo($target_file, PATHINFO_EXTENSION);
      $file_extension = strtolower($file_extension);
      $valid_extension = array("png","jpeg","jpg","pdf");

      //check if file extension is valid
      if(in_array($file_extension, $valid_extension)) {

        if(move_uploaded_file($_FILES['files']['tmp_name'][$i], $target_file)){
          // execute query to insert file data into database
          $statement->execute(array($filename,$target_file));
          $uploadSuccess = true; 
          
        }  
      }
      else{
        $valid_file=false;
      }
    }
  }
?>
    <main>
        <!-- Site top -->
        <section>
            <div class="container mt-5 text-center">
                <h1>Credipesca - O Pescador</h1>
                <p>O seu sistema de cadastro para pescadores.</p>
            </div>
        </section>
        <section class="form-row row mt-5 text-center">
            <div class="col-sm-12 col-md-6 col-lg-6 signup">
                <h3>Cadastre o pescador.</h3>
                <a href="display-user.php"><button type="button" class="btn btn-light mt-3 btn-signup">Cadastro</button></a>
            </div>
             <div class="col-sm-12 col-md-6 col-lg-6 text-center login">
                 <h3>Entre na sua conta.</h3>
                 <a href="login.php"><button type="button" class="btn btn-dark mt-3 btn-login" href="login.php">Entrar</button></a>
             </div>
        </section>
    </main>
<?php require ('./inc/footer.php'); ?>
