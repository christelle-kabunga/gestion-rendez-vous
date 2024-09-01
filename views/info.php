<?php 
include '../connexion/connexion.php'; // Connexion à la base de données
require_once('../models/select/select-information.php'); // Appel de la page pour les affichages
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Information</title>
    <?php require_once('style.php'); ?> <!-- Inclure les styles -->
    <!-- Ajoutez Bootstrap si ce n'est pas déjà inclus -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-4">
        <!-- Content Header (Page header) -->
        <div class="text-center mb-4">
            <h1>Informations sur les médecins</h1>
        </div>

        <!-- Début de la rangée Bootstrap -->
        <div class="row">
        <?php 
            // Requête SQL pour sélectionner toutes les informations
            $req = $connexion->prepare("SELECT * FROM medecins"); // ou utilisez `information` si nécessaire
            $req->execute();
            while ($donne = $req->fetch()) { ?>
            <!-- Card d'informations du médecin -->
            <div class="col-md-6 mb-4"> <!-- Chaque carte prend la moitié de la largeur sur les écrans moyens et plus grands -->
                <div class="card">
                    <img src="../models/add/img/<?php echo htmlspecialchars($donne['photo']); ?>" class="card-img-top" alt="Photo du médecin">
                    <div class="card-body">
                        <h5 class="card-title text-primary"><?php echo htmlspecialchars($donne['prenom']) . " " . htmlspecialchars($donne['nom']); ?></h5>
                        <p class="card-text"><b>Spécialité:</b> <?php echo htmlspecialchars($donne['description']); ?></p>
                        <p class="card-text"><b>Téléphone:</b> <?php echo htmlspecialchars($donne['telephone']); ?></p>
                    </div>
                    <div class="card-footer">
                        <a href="inscription.php?id=<?php echo htmlspecialchars($donne['id']); ?>" class="btn btn-secondary">Prendre rendez-vous</a>
                    </div>
                </div>
            </div>
        <?php } ?>
        </div> <!-- Fin de la rangée Bootstrap -->
    </div>

    <?php require_once('script.php'); ?> <!-- Inclure les scripts -->
</body>
</html>
