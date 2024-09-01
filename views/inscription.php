<?php 
// Récupérer l'ID du médecin de l'URL
if (isset($_GET['id'])) {
    $id_medecin = htmlspecialchars($_GET['id']);
    // Vous pouvez maintenant utiliser $id_medecin pour vos requêtes ou formulaires
} else {
    // Gérer le cas où l'ID n'est pas passé dans l'URL
    echo "Aucun médecin sélectionné.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <?php require_once('style.php'); ?> <!-- Inclure les styles -->
</head>
<body>
    <!-- Formulaire d'inscription avec le médecin sélectionné -->
    <div class="container my-4">
        <h2>Inscription pour un rendez-vous avec le médecin <?php echo $id_medecin; ?></h2>
        <!-- Formulaire d'inscription ici -->
    </div>

    <?php require_once('script.php'); ?> <!-- Inclure les scripts -->
</body>
</html>
