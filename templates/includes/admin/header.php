<?php
if (!isset($_SESSION['LOGGED_ADMIN'])){
    header('Location:/car-location');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Back Office</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-sm bg-primary" data-bs-theme="dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">BoxShadow</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <?php
            if (isset($_SESSION['LOGGED_ADMIN'])) {
            ?>
              <li class="nav-item">
                <a class="nav-link" href="/car-location/backoffice">Back-Office</a>
              </li>

            <?php
            }
            ?>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="/car-location/">Accueil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/car-location/contact">Contact</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/car-location/inscription">Inscription</a>
            </li>
            <?php if (isset($_SESSION['LOGGED_ID'])) {
            ?>
              <li class="nav-item">
                <a class="nav-link" href="/car-location/deconnexion">Déconnexion</a>
              </li>
            <?php
            } else {

            ?>
              <li class="nav-item">
                <a class="nav-link" href="/car-location/connexion">Connexion</a>
              </li>
            <?php
            }
            ?>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <main>

    <?php

    App\Core\Session::getMessage();
    // var_dump($_SESSION);
    
   //on peut mettre un use \App\Core\Session; et ensuite Session::getMessage();