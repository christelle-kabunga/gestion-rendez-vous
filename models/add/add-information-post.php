<?php
include('../../connexion/connexion.php');
require_once ('../../fonctions/fonctions.php');
if (isset($_POST['valider'])) {
//inserer un fichier
// recuperer l'image
$image = $_FILES['photo']['name'];
$file = $_FILES['photo'];
$destination = "img/" . basename($image);
// fonction permettant de recuperer la photo
    $newimage = RecuperPhoto($image, $file, $destination);
    $titre = htmlspecialchars($_POST['titre']);
    $contenu = htmlspecialchars($_POST['contenu']);
    $date=date("Y-m-d");
   
    // Check if the information already exists in the database
    $getpatDeplicant = $connexion->prepare("SELECT * FROM information WHERE titre=? AND contenu=? and supprimer=?");
    $getpatDeplicant->execute([$titre,$contenu, 0]);
    $tab = $getpatDeplicant->fetch();

    if ($tab > 0) {
        $_SESSION['msg'] = 'Cette information existe déjà dans la base de données'; // This variable receives the message to notify the user of the operation they have already done
        header("location:../../views/information.php");
    } else {
        // Verify the validity of the phone number
            $req = $connexion->prepare("INSERT INTO information (id,titre,contenu,date,photo) VALUES (?,?,?,?,?)");
            $resultat = $req->execute(['NULL', $titre,$contenu,$date,$newimage]);

            // If yes, the result variable will return true, so there was a registration
            if ($resultat == true) {
                $_SESSION['msg'] = "Enregistrement  réussie"; // This line allows you to add a message to the session When there has been a registration
                header("location:../../views/information.php");
            } else {
                $_SESSION['msg'] = "Echec d'enregistrement"; // This line allows you to add a message to the session When there has been a registration
                header("location:../../views/information.php");
            }
    }
} else {
    // This line allows you to redirect the user when they have not clicked the button that is used to save
    header("location:../../views/information.php");
}
