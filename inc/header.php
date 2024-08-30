<?php
session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Credipesca - O Pescador</title>
    <meta name="description" content="This week we will look at how we can protect pages behind a level of authentication.">
    <meta name="robots" content="noindex, nofollow">
    <!-- fonts import -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <!-- end of fonts import -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" ></script>
    <!-- CSS -->
    <link rel="stylesheet" href="./css/style.css">
  </head>
  <body>
    <header>
      <nav class="navbar navbar-expand-lg bg-light">
      <div class="container-fluid">
          <a class="navbar-brand me-auto" href="index.php">
              <img src="./img/logo.png" alt="logo" width="20%">
          </a>

          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
              <ul class="navbar-nav mb-2 mb-lg-0">
                  <li class="nav-item me-5">
                      <a class="nav-link" href="index.php">Início</a>
                  </li>
                  <li class="nav-item me-5">
                      <a class="nav-link" href="display-user.php">Pescadores</a>
                  </li>
                  <?php if (!isset($_SESSION['user_id'])): ?>
                  <li class="nav-item me-5">
                      <a href="login.php" class="btn btn-primary">Login</a>
                  </li>
                  <?php else: ?>
                  <li class="nav-item me-5">
                      <a href="logout.php" class="btn btn-danger">Logout</a>
                  </li>
                  <?php endif; ?>
              </ul>
          </div>
      </div>
      </nav>

    </header>
