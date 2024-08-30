<?php
include('../../connexion/connexion.php');
if (isset($_POST['valider'])) {
//inserer un fichier

    $description = htmlspecialchars($_POST['description']);
    $date=date("Y-m-d");
   
    // Check if the consultation already exists in the database
    $getpatDeplicant = $connexion->prepare("SELECT * FROM consultation WHERE  description=? and supprimer=?");
    $getpatDeplicant->execute([$description, 0]);
    $tab = $getpatDeplicant->fetch();

    if ($tab > 0) {
        $_SESSION['msg'] = 'Cette consultation existe déjà dans la base de données'; // This variable receives the message to notify the user of the operation they have already done
        header("location:../../views/consultation.php");
    } else {
        // Verify the validity of the phone number
            $req = $connexion->prepare("INSERT INTO consultation (id ,description,date) VALUES (?,?,?)");
            $resultat = $req->execute(['NULL',$description,$date]);

            // If yes, the result variable will return true, so there was a registration
            if ($resultat == true) {
                $_SESSION['msg'] = "Enregistrement  réussie"; // This line allows you to add a message to the session When there has been a registration
                header("location:../../views/consultation.php");
            } else {
                $_SESSION['msg'] = "Echec d'enregistrement"; // This line allows you to add a message to the session When there has been a registration
                header("location:../../views/consultation.php");
            }
    }
} else {
    // This line allows you to redirect the user when they have not clicked the button that is used to save
    header("location:../../views/consultation.php");
}
