<?php
require_once("connect.php");

function getBottlesBD(){
    $pdo = MonPDO::getPDO();
    $req = "SELECT * FROM bouteilles";
    $stmt = $pdo->prepare($req);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getBottleNameToDeleteBD($id){
    $pdo = MonPDO::getPDO();
    $req = 'SELECT CONCAT(id, " : ",nom) as myBottle FROM bouteilles WHERE id = :bouteilles';
    $stmt = $pdo->prepare($req);
    $stmt->bindValue(":bouteilles", $id,PDO::PARAM_INT);
    $stmt->execute();
    $res = $stmt->fetch(PDO::FETCH_ASSOC);
    return $res['myBottle'];
}

function deleteBottleBD($id){
    $pdo = MonPDO::getPDO();
    $req = 'DELETE FROM bouteilles WHERE id = :bouteilles';
    $stmt = $pdo->prepare($req);
    $stmt->bindValue(":bouteilles", $id,PDO::PARAM_INT);
    return $stmt->execute();
}

function modifierBottleBD($id,$nom,$annee,$cepage,$region, $pays, $commentaires, $nomImage){
    $pdo = MonPDO::getPDO();
    $req = '
    UPDATE bouteilles 
    set nom = :nom, annee = :annee, cepage = :cepage, region = :region, pays = :pays, commentaires = :commentaires'; 
    if($nomImage !== "")  $req .=', image=:image ';
    $req .=' WHERE id = :bouteilles';
    $stmt = $pdo->prepare($req);
    $stmt->bindValue(":bouteilles", $id,PDO::PARAM_INT);
    $stmt->bindValue(":nom", $nom,PDO::PARAM_STR);
    $stmt->bindValue(":annee", $annee,PDO::PARAM_STR);
    $stmt->bindValue(":cepage", $cepage,PDO::PARAM_STR);
    $stmt->bindValue(":region", $region,PDO::PARAM_STR);
    $stmt->bindValue(":pays", $pays,PDO::PARAM_STR);
    $stmt->bindValue(":commentaires", $commentaires,PDO::PARAM_STR);
    if($nomImage !== "") $stmt->bindValue(":image", $nomImage,PDO::PARAM_STR);
    return $stmt->execute();
}

function ajoutBottleBD($nom,$annee,$cepage,$region, $pays, $commentaires, $image){
    $pdo = MonPDO::getPDO();
    $req = 'INSERT into bouteilles (nom,annee,cepage,region,pays,commentaires,image)
    values(:nom,:annee,:cepage,:region,:pays,:commentaires, :image)';
    $stmt = $pdo->prepare($req);
    $stmt->bindValue(":nom", $nom,PDO::PARAM_STR);
    $stmt->bindValue(":annee", $annee,PDO::PARAM_STR);
    $stmt->bindValue(":cepage", $cepage,PDO::PARAM_STR);
    $stmt->bindValue(":region", $region,PDO::PARAM_STR);
    $stmt->bindValue(":pays", $pays,PDO::PARAM_STR);
    $stmt->bindValue(":commentaires", $commentaires,PDO::PARAM_STR);
    $stmt->bindValue(":image", $image,PDO::PARAM_STR);
    return $stmt->execute();
}

function getImageToDelete($id){
    $pdo = MonPDO::getPDO();
    $req = 'SELECT image FROM bouteilles WHERE id = :bouteilles';
    $stmt = $pdo->prepare($req);
    $stmt->bindValue(":bouteilles", $id,PDO::PARAM_INT);
    $stmt->execute();
    $res = $stmt->fetch(PDO::FETCH_ASSOC);
    return $res['image'];
}