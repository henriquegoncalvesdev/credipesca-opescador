<?php
  require './inc/header.php';

  session_start();

// check if user is logged in
if (isset($_SESSION['user_id'])) {
    header("Location: display-person.php");
    exit;
}

?>  
<section class="signin-masthead text-center mt-5">
    <div>
      <h3>O Pescador - Seus Clientes</h3>
    </div>
  </section>
  <main>
    <section class="row signin-row">
        <div class="col align-self-center mt-5 text-center">
            <h3>Entre na sua conta</h3>
            <form method="post" action="./inc/validate.php">
            <p><input class="form-control" name="username" type="text" placeholder="Username" required /></p>
            <p><input class="form-control" name="password" type="password" placeholder="Password" required /></p>
            <input class="btn btn-dark btn-register" type="submit" value="Login" />
            </form>
        </div>
    </section>
  </main>

<?php
    require './inc/footer.php';
?>