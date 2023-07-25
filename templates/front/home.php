<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <div>
        <?php
        foreach($cars as $car){
        ?>
            <h1><?= $car['name']; ?></h1>
            <p><?= $car['description']; ?></p>
            <img src="car-location/public/img <?= $car['image']; ?>" alt=""><a href="/car-location/contact/form <?= $car['id']; ?>">reserver</a>
            <?php
        }
        ?>
    </div>

    <div class="card" style="width: 18rem;">
        <img src="car-location/public/img" <?= $car['image']; ?> class="card-img-top" alt="une fiat 500">
        <div class="card-body">
            <h5 class="card-title"><?= $car['name'];?></h5>
            <p class="card-text"><?= $car['description']; ?></p>
            <a href="/car-location/contact/form <?= $car['id']; ?>" class="btn btn-primary">Réserver</a>
        </div>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>