<?php
// Include the database connection
include '../connexion/connexion.php';//Se connecter à la BD

// Retrieve the doctor's ID from the URL
if (isset($_GET['id'])) {
    $id_medecin = htmlspecialchars($_GET['id']);
    
    // Prepare and execute the query to get the doctor's information
    $stmt = $connexion->prepare("SELECT nom, postnom, prenom FROM medecins WHERE id = :id");
    $stmt->bindParam(':id', $id_medecin, PDO::PARAM_INT);
    $stmt->execute();

    // Check if a doctor is found
    if ($stmt->rowCount() > 0) {
        $medecin = $stmt->fetch(PDO::FETCH_ASSOC);
        $nom_complet_medecin = $medecin['nom'] . ' ' . $medecin['postnom'] . ' ' . $medecin['prenom'];
    } else {
        $nom_complet_medecin = "Médecin inconnu";
    }
} else {
    $nom_complet_medecin = "Aucun médecin sélectionné";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <?php require_once('style.php'); ?> <!-- Inclure les styles -->
    <!-- Ajoutez Bootstrap si ce n'est pas déjà inclus -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8 col-md-10 col-sm-12">
                <h2 class="text-center mb-4">Inscription pour un rendez-vous avec le médecin : <?php echo htmlspecialchars($nom_complet_medecin); ?></h2>
                <!-- Formulaire d'inscription ici -->
                <form method="POST" action="../models/add/add-register.php" class="card p-4">
                    <h5 class="title">Créer un compte</h5>
                    <div class="row">
                        <?php if(isset($_SESSION['msg']) && $_SESSION['msg']!=""){?>
                            <div class="col-12">
                                <div class="alert alert-success text-center"><?php echo $_SESSION['msg']; ?></div>
                            </div>
                        <?php } ?>
                        <div class="col-12 mb-3">
                            <label for="">Nom</label>
                            <input type="text" class="form-control" placeholder="Ex: Dato" name="nom" required>
                            <input type="hidden" name="id_medecin" value="<?php echo htmlspecialchars($id_medecin); ?>">
                        </div>
                    
                        <div class="col-12 mb-3">
                            <label for="">Postnom</label>
                            <input type="text" class="form-control" placeholder="Ex: agioni" name="postnom" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="">Prénom</label>
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
                            <label for="">Téléphone</label>
                            <input type="text" class="form-control" placeholder="Ex: 000000000" name="telephone" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="">Adresse</label>
                            <input type="text" class="form-control" placeholder="Ex: butembo" name="adresse" required>
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
            </div>
        </div>
    </div>

    <div class="fixed-bottom container text-center pb-4">
        <span>Droit réservé</span>
    </div>

    <?php require_once('script.php'); ?> <!-- Inclure les scripts -->
</body>
</html>
