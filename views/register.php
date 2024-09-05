<?php
 include '../connexion/connexion.php';//Se connecter à la BD
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
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
    <form method="POST" action="../models/add/add-register.php" class="col-xl-4 col-lg-5 col-sm-7 col-md-6 card p-4">
        <h5 class="title">Créer un compte</h5>
        <div class="row">
        <?php if(isset($_SESSION['msg']) && $_SESSION['msg']!=""){?>
            <div class="col-12 ">

                <div class="alert alert-sucess text-center"><?php  echo $_SESSION['msg'];?></div>
            </div>
            <?php } ?>
            <div class="col-12 mb-3">

                <label for="">nom</label>
                <input type="text" class="form-control" placeholder="Ex: dato" name="nom" required>
            </div>
             <div class="col-12 mb-3">

                <label for="">postnom</label>
                <input type="text" class="form-control" placeholder="Ex: agioni" name="postnom" required>
            </div>
            <div class="col-12 mb-3">

            <label for="">prenom</label>
            <input type="text" class="form-control" placeholder="Ex: aimerance" name="prenom" required>
            </div>
            <div class="col-12 mb-3">
                  <label>Genre</label>
                  <select class="form-control select2" required id="" name="genre" autocomplete="off" style="width: 100%;">
                 
                    <option value="Masculin" Selected>Masculin</option>
                                   
                                            <option value="" desabled>Choisir un genre</option>
                                            <option value="Masculin">Masculin</option>
                                            <option value="Feminin">Feminin</option>
                  </select>
                </div>
            <div class="col-12 mb-3">

            <label for="">telephone</label>
            <input type="text" class="form-control" placeholder="Ex: 000000000" name="telephone" required>
            </div>
            <div class="col-12 mb-3">
                <label for="">Mot de passe</label>
                <input type="password" class="form-control" placeholder="Ex: *****" name="pwd" required>
            </div>
            <div class="col-12 mb-3">
                <input type="submit" class="form-control btn-dark btn" name="valider" value="S'enregistrer">
            </div>
        </div>
    </form>
    <div class="fixed-bottom container text-center pb-4">
        <span>Droit réservé</span>
    </div>
</body>

</html>

