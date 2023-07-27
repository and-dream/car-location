<?php
require_once '../templates/includes/header.php';
?>
<h1>Se connecter</h1>

<section class="container py-3">
<form action="/car-location/connect" method="post" class="w-75 mt-auto p-3 border border-light-subtle">
  <div class="mb-3">
    <label for="mail" class="form-label">Email</label>
    <input type="email" class="form-control" id="mail" name="email">
  </div>
  <div class="mb-3">
    <label for="mdp" class="form-label">Mot de passe</label>
    <input type="password" class="form-control" id="mdp" name="password">
  </div>
  <button type="submit" class="btn btn-primary">Se connecter</button>
</form>
</section>


<?php
require_once '../templates/includes/footer.php';
?>