
<?php
 include '../connexion/connexion.php';//Se connecter à la BD
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<style>
body {
    min-height: 100vh;
}
</style>
<?php require_once('style.php')?>
<body class="d-flex justify-content-center align-items-center px-3 mt-5">
    <div class="fixed-top container text-center pt-4">
        <span></span>
    </div>
    <form method="POST" action="../models/login.php" class="col-xl-4 col-lg-5 col-sm-7 col-md-6 card p-4">
        <h5 class="title">Connexion</h5>
        <div class="row">
            <div class="col-12 mb-3">

                <label for="">username</label>
                <input type="text" class="form-control" placeholder="Ex: kabunga" name="username">
            </div>
            <div class="col-12 mb-3">
                <label for="">Mot de passe</label>
                <input type="password" class="form-control" placeholder="Ex: *****" name="pwd">
            </div>
            <?php if(isset($_SESSION['msg']) && $_SESSION['msg']!=""){?>
            <div class="col-12 ">

                <div class="alert alert-danger text-center"><?php  echo $_SESSION['msg'];?></div>
            </div>
            <?php } ?>
            <div class="col-12 mb-3">
                <input type="submit" class="form-control btn-dark btn" name="connect" value="Se connecter">
            </div>
            <div class="col-12 mb-3 d-flex justify-content-between">
                <a href="register.php">Vous n'avez pas de compte ? S'enregistrer</a>
            </div>
        </div>
    </form>
    <div class="fixed-bottom container text-center pb-4">
        <span>Droit réservé</span>
    </div>
</body>

</html>

