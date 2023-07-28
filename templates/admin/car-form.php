<?php
require_once '../templates/includes/admin/header.php';
?>

<section class="container py-3">
    <h1>Modifier une voiture</h1>
    <!-- ajouter un attribut enctype pour pouvoir télécharger des images dans l'input parcourir-->
    <form action="/car-location/backoffice/form-car" method="post" enctype="multipart/form-data">
        <!--je récupère un champ grâce à son attribut name-->
        <input type="text" value="<?= $carDetails['id']; ?>" name="id" hidden>
        <div class="mb-3">
            <label for="modele" class="form-label">Modèle</label>
            <input type="text" class="form-control" id="modele" name="modele" value="<?= $carDetails['name'] ?>">

        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" rows="3" name="description">
            <?= $carDetails['description']; ?>
        </textarea>
            <!-- textarea ne prend pas de value -->
        </div>
        <div class="mb-3">
            <label for="prix" class="form-label">Prix</label>
            <input type="text" class="form-control" id="prix" name="prix" value="<?= $carDetails['price']; ?>">
        </div>
        <div>
            <div class="mb-3">
                <div>
                    <img src="/car-location/public/img/upload/<?= $carDetails['image']; ?>" alt="" class="img-thumb"> <!-- $carDetails -->
                </div>
                <label for="fichier" class="form-label">Télécharger une image</label>
                <input class="form-control" type="file" id="fichier" name="fichier">
            </div>

            <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
</section>

<?php
require_once '../templates/includes/footer.php';
?>