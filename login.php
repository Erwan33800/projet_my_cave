<?php
$error = null;
$password = '$2y$12$bkZmWIkJTLgXeKYW4pLm4.ZRfRtuSExNsDtXhaqsg7KRwXT0vRZz2'; // = echo password_hash('bordeaux', PASSWORD_DEFAULT, ['cost' => 12]);
if (!empty($_POST['pseudo']) && !empty($_POST['motdepasse'])) {
    if ($_POST['pseudo'] === 'mycave' && password_verify($_POST['motdepasse'], $password)) {
        session_start();
        $_SESSION['connecte'] = 1;
        header('Location: index2.php');
    } else {
        $erreur = "Identifiants incorrects";
    }
}

require 'auth.php';
if (est_connecte()) {
    header('Location: index2.php');
    exit();
}


?>
<!DOCTYPE html>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="css/style2.css">
<body style="background-color: #885c7e;"> 

    <?php if ($error): ?>
    <div class="alert alert-danger">
        <?= $error ?>
    </div>
    <?php endif ?>

   
    <div class="login">
        <img src="img/logo-blanc.png" alt="Logo My Cave" class="logo">
        <form action="" class="col-md-6"method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="pseudo" placeholder="Nom d'utilisateur">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="motdepasse" placeholder="Votre mot de passe">
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Se connecter</button>
                <a class="btn btn-primary" href="index.php" sytle="color: white;">Accueil</a>
            </div>
        </form>
        <div class="cube1"></div>
        <div class="cube2"></div>
        <div class="cube3-1"></div>
        <div class="cube3-2"></div>
        <div class="cube3-3"></div>
        <div class="cube4-1"></div>
        <div class="cube4-2"></div>
        <div class="cube4-3"></div>
    </div>