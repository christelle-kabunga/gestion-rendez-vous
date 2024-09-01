<?php 
include '../connexion/connexion.php'; // Se connecter à la BD
require_once('../models/select/select-information.php'); // Appel de la page pour les affichages
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Information</title>
    <?php require_once('style.php'); ?> <!-- Inclure les styles -->
</head>
<body>
    <div class="container my-4">
        <!-- Content Header (Page header) -->
        <div class="text-center mb-4">
            <h1>Informations sur les médecins</h1>
        </div>

        <div class="row">
            <!-- Card 1 -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <img src="../img/photo-dun-médecin-mature-à-laide-dune-tablette-numérique-dans-un-hôpital-moderne.jpg" class="card-img-top" alt="Photo">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Jonathan kambale.</h5>
                        <p class="card-text"> <b>Cardiologue:</b>  Spécialiste du cœur et du système circulatoire. Il diagnostique et traite les maladies cardiovasculaires (infarctus, angine de poitrine, arythmies).</p>
                    </div>
                    <div class="card-footer">
       
                        <button class="btn btn-secondary" type="submit">Prendre rendez-vous</button>

                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-md-6 mb-4">
                <div class="card">
                <img src="../img/nous-offrons-à-nos-patients-des-soins-de-santé-haut-de-gamme-ici.jpg" class="card-img-top" alt="Photo">
                    <div class="card-body">
                    <h5 class="card-title text-primary">Chris Kite.</h5>
                        <p class="card-text"> <b>Dermatologue: </b> S'occupe des maladies de la peau, des cheveux et des ongles. Il traite l'eczéma, le psoriasis, l'acné et les cancers de la peau.</p>
                    </div>
                    <div class="card-footer">
       
                                    <button class="btn btn-secondary" type="submit">Prendre rendez-vous</button>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require_once('script.php'); ?> <!-- Inclure les scripts -->
</body>
</html>
