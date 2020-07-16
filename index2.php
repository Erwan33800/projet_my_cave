<?php
$title = "Mes Vins";
require_once 'header.php';
require_once 'connect.php';
require_once 'functions.php';
require_once 'gestionImage.php';

//VERIFICATION DE SUPPRESSION
if(isset($_GET['type']) && $_GET['type'] === "suppression"){
    $bottleNameToDelete = getBottleNameToDeleteBD($_GET['id']);
    ?>
    <div class="alert alert-warning" role="alert">
        Voulez vous vraiment <b class="text-danger">supprimer</b> la bouteille <b> <?= $bottleNameToDelete ?></b> de la bd ?
        <a href="?delete=<?= $_GET['id'] ?>" class="btn btn-danger">Supprimer ! </a>
        <a href="index2.php" class="btn btn-success">Annuler ! </a>
    </div>
<?php
}

//SUPPRESSION
if(isset($_GET['delete'])){
    $imageToDelete = getImageToDelete($_GET['delete']);
    deleteImage("sources/",$imageToDelete);
    $success = deleteBottleBD($_GET['delete']);
    if($success){ ?>
        <div class="alert alert-success" role="alert">
            La suppression s'est bien déroulée !
        </div>
    <?php } else { ?>
        <div class="alert alert-danger" role="alert">
            La suppression n'a pas fonctionnée !
        </div>
    <?php }
}

//MODIFICATION
if(isset($_POST['type']) && $_POST['type'] === "modificationEtape2"){
    $nomNouvelleImage = "";
    if($_FILES['imageBottle']['name'] !== ""){
        $imageToDelete = getImageToDelete($_POST['id']);
        deleteImage("sources/",$imageToDelete);
        $fileImage = $_FILES['imageBottle'];
        $repertoire = "sources/";
        try{
            $nomNouvelleImage = ajoutImage($fileImage,$repertoire,$_POST['nomBottle']);
        } catch(Exception $e){
            echo $e->getMessage();
        }
    }
    $success = modifierBottleBD($_POST['id'], $_POST['nomBottle'],$_POST['anneeBottle'], $_POST['cepageBottle'], $_POST['regionBottle'], $_POST['paysBottle'], $_POST['descBottle'], $nomNouvelleImage);
    if($success){ ?>
        <div class="alert alert-success" role="alert">
            La modification s'est bien déroulée !
        </div>
    <?php } else { ?>
        <div class="alert alert-danger" role="alert">
            La modification n'a pas fonctionnée !
        </div>
    <?php }
}

$bottles = getBottlesBD();
?>
<div style="background-color: #885c7e;">
<a href="logout.php" class="btn btn-danger">Déconnexion</a>
<a href="ajout.php" class="btn btn-primary">Ajout</a>

<div class="row no-gutters text-center">
    <?php foreach($bottles as $b) : ?>
        <div class="col-4 box">
            <div class="card m-5" style="background-color: #88002d; color: grey;">
                <?php if(!isset($_GET['type'])  || $_GET['type'] !== "modification" || $_GET['id'] !== $b['id']) { ?>
                    <div class="image">
                        <img src="sources/<?= $b['image'] ?>" class="card-img-top col-4" alt="...">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?= $b['nom'] ?> - <?= $b['annee'] ?></h5>
                        <p class="card-text"><?= $b['commentaires'] ?></p>
                        <p class="card-text"><?= $b['cepage'] ?></p>
                        <p class="card-text"><?= $b['pays'] ?></p>
                        <p class="card-text"><?= $b['region'] ?></p>
                    </div>
                    <div class="row no-gutters p-2">
                        <form action="" method="GET" class="col-6 text-center">
                            <input type="hidden" name="id" value="<?= $b['id'] ?>">
                            <input type="hidden" name="type" value="modification">
                            <input type="submit" value="modifier" class="btn btn-primary">
                        </form>
                        <form action="" method="GET" class="col-6 text-center">
                            <input type="hidden" name="id" value="<?= $b['id'] ?>">
                            <input type="hidden" name="type" value="suppression">
                            <input type="submit" value="supprimer" class="btn btn-danger">
                        </form>
                    </div>
                <?php } else { ?>
                    <form action="" method="POST" enctype="multipart/form-data" class="">
                        <input type="hidden" name="type" value="modificationEtape2"/>
                        <input type="hidden" name="nom" value="<?= $b['id'] ?>">
                        
                            <div class="form-group">
                                <label>Nouvelle image de la bouteille : </label>
                                <input type="file" class="form-control-file" name="imageBottle" >
                            </div>
                            <div class="form-group md-2">
                                <label>Nom de la bouteille :</label>
                                <input type="text" class="form-control" name="nomBottle" value="<?= $b['nom'] ?>" />
                            </div>
                            <div class="form-group">
                                <label>Millésime de la bouteille :</label>
                                <input type="text" class="form-control" name="anneeBottle" value="<?= $b['annee'] ?>" />
                            </div>
                            <div class="form-group">
                                <label>Région de la bouteille :</label>
                                <input type="text" class="form-control" name="regionBottle" value="<?= $b['region'] ?>" />
                            </div>
                            <div class="form-group">
                                <label>Pays de la bouteille :</label>
                                <input type="text" class="form-control" name="paysBottle" value="<?= $b['pays'] ?>" />
                            </div>
                            <div class="form-group">
                                <label>Cépage de la bouteille :</label>
                                <input type="text" class="form-control" name="cepageBottle" value="<?= $b['cepage'] ?>" />
                            </div>
                            <div class="form-group">
                                <label>Description de la bouteille : </label>
                                <textarea name="descBottle" row="3" class="form-control"> <?= $b['description'] ?> </textarea>
                            </div>
                        <div class="row no-gutters p-2">
                            <div class="col text-center">
                                <input type="submit" value="Valider" class="btn btn-success">
                            </div>
                            <div class="col text-center">
                                <input type="submit" value="Annuler" onclick="cancelModification(event)" class="btn btn-danger">
                            </div>
                        </div>
                    </form>
                <?php } ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>
</div>

<script src="monJS.js"></script>