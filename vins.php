<?php
$title = "Mes Vins";
require_once 'header.php';
require_once 'connect.php';
require_once 'functions.php';

$bottles = getBottlesBD();
?>

<div class="row no-gutters text-center" style="background-color: #885c7e;">
    <?php foreach($bottles as $b) : ?>
        <div class="col-4 box">
            <div class="card m-5" style="background-color: #88002d; color: grey;">
                <div class="image">
                    <img src="sources/<?= $b['image'] ?>" class="card-img-top col-4" alt="...">
                </div>
                <div class="card-body content">
                    <h5 class="card-title"><?= $b['nom'] ?> - <?= $b['annee'] ?></h5>
                    <p class="card-text"><?= $b['commentaires'] ?></p>
                    <p class="card-text">Cépage : <?= $b['cepage'] ?></p>
                    <p class="card-text">Pays : <?= $b['pays'] ?></p>
                    <p class="card-text">Région : <?= $b['region'] ?></p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>