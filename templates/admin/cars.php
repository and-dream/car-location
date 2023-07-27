<?php
require_once '../templates/includes/admin/header.php';
?>

<section>
    <table>
        <?php
            foreach ($cars as $car) {           
        ?>
        <tr>
            <td><?= $car['id']; ?></td>
            <td><?= $car['name']; ?></td>
            <td><?= $car['description'];?></td>
            <td><?= $car['image']; ?></td>
            <td><?= $car['price']?></td>
        </tr>
        <?php
}
?>
</table>
</section>

<?php
require_once '../templates/includes/footer.php';
?>