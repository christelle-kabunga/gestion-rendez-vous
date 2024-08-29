<?php
include('../../connexion/connexion.php');

if (isset($_POST['valider'])) {

    $patient = htmlspecialchars($_POST['patient']);
    $medecin = htmlspecialchars($_POST['medecin']);
    $date = htmlspecialchars($_POST['date']);
   
    // Check if the rendez-vous already exists in the database
    $getpatDeplicant = $connexion->prepare("SELECT * FROM rendez_vous WHERE patient=? AND medecin=? and supprimer=?");
    $getpatDeplicant->execute([$patient,$medecin, 0]);
    $tab = $getpatDeplicant->fetch();

    if ($tab > 0) {
        $_SESSION['msg'] = 'Ce rendez-vous existe déjà dans la base de données'; // This variable receives the message to notify the user of the operation they have already done
        header("location:../../views/rendez-vous.php");
    } else {
            $req = $connexion->prepare("INSERT INTO rendez_vous( id,patient,medecin,date) VALUES (?,?,?,?)");
            $resultat = $req->execute(['NULL', $patient,$medecin,$date]);

            // If yes, the result variable will return true, so there was a registration
            if ($resultat == true) {
                $_SESSION['msg'] = "Enregistrement a réussie"; // This line allows you to add a message to the session When there has been a registration
                header("location:../../views/rendez-vous.php");
            } else {
                $_SESSION['msg'] = "Echec d'enregistrement"; // This line allows you to add a message to the session When there has been a registration
                header("location:../../views/rendez-vous.php");
            }
    }
} else {
    // This line allows you to redirect the user when they have not clicked the button that is used to save
    header("location:../../views/rendez-vous.php");
}
