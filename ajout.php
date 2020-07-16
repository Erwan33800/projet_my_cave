<?php
$titre = "Page d'ajout d'une bouteille";
require_once 'header.php';
require_once 'connect.php';
require_once 'functions.php';
require_once 'gestionImage.php';

if(isset($_POST['nom'])){
    $fileImage = $_FILES['imageBottle'];
    $repertoire = "sources/";
    try{
        $nomImage = ajoutImage($fileImage,$repertoire,$_POST['nom']);
        $success = ajoutBottleBD($_POST['nom'],$_POST['annee'],$_POST['cepage'],$_POST['pays'],$_POST['region'],$_POST['commentaires'],$nomImage);
        if($success){ ?>
            <div class="alert alert-success" role="alert">
                L'ajout s'est bien déroulé !
            </div>
        <?php } else { ?>
            <div class="alert alert-danger" role="alert">
                L'ajout n'a pas fonctionné !
            </div>
        <?php }
    } catch(Exception $e){
        echo $e->getMessage();
    }
}
?>
<div style="background-color: #885c7e;">
    <form method="POST" action="" enctype="multipart/form-data" class="col-6">
        <div class="form-group">
            <label>Nom de la bouteille : </label>
            <input type="text" class="form-control" name="nom" placeholder="Nom de la bouteille" required />
        </div>
        <div class="form-group">
            <label>Millésime de la bouteille : </label>
            <input type="text" class="form-control" name="annee" placeholder="Millésime de la bouteille" required />
        </div>
        <div class="form-group">
            <label>Description de la bouteille : </label>
            <textarea class="form-control" name="commentaires" row="3" required></textarea>
        </div>
        <div class="form-group">
            <label>Cépage(s) : </label>
            <input class="form-control" name="cepage" placeholder="Cépage(s)" required>
        </div>
        <div class="form-group">
            <label>Pays : </label>
            <input class="form-control" name="pays" placeholder="Pays d'origine" required>
        </div>
        <div class="form-group">
            <label>Région : </label>
            <input class="form-control" name="region" placeholder="Région" required>
        </div>
        <div class="form-group">
            <label>Image de la bouteille : </label>
            <input type="file" class="form-control-file" name="imageBottle" >
        </div>
        <input type="submit" class="btn btn-primary mb-4" value="Valider" />
    </form>
</div>

