<?php
require_once '../templates/includes/front/header.php';
?>
<h1>S'inscrire</h1>

<section class="container py-3">
<form action="/car-location/save-user" method="post" class="w-75 mt-auto p-3 border border-light-subtle">
<div class="mb-3 py-3">
    <label for="pseudo" class="form-label">Pseudo</label>
    <input type="text" class="form-control" id="pseudo" name="username">
  </div>
  <div class="mb-3">
    <label for="mail" class="form-label">Email</label>
    <input type="email" class="form-control" id="mail" name="email">
  </div>
  <div class="mb-3">
    <label for="mdp" class="form-label">Mot de passe</label>
    <input type="password" class="form-control" id="mdp" name="password">
  </div>
  <button type="submit" class="btn btn-primary">S'inscrire</button>
</form>
</section>


<?php
require_once '../templates/includes/footer.php';
?>