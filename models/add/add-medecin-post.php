<?php
include('../../connexion/connexion.php');

if (isset($_POST['valider'])) {

    $nom = htmlspecialchars($_POST['nom']);
    $postnom = htmlspecialchars($_POST['postnom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $genre = htmlspecialchars($_POST['genre']);
    $adresse = htmlspecialchars($_POST['adresse']);
    $telephone = htmlspecialchars($_POST['telephone']);
   
    // Check if the medecin already exists in the database
    $getpatDeplicant = $connexion->prepare("SELECT * FROM medecins WHERE telephone=? AND supprimer=?");
    $getpatDeplicant->execute([$telephone, 0]);
    $tab = $getpatDeplicant->fetch();

    if ($tab > 0) {
        $_SESSION['msg'] = 'Ce medecin existe déjà dans la base de données'; // This variable receives the message to notify the user of the operation they have already done
        header("location:../../views/medecin.php");
    } else {
        // Verify the validity of the phone number
        if (is_numeric($telephone)) {
            $req = $connexion->prepare("INSERT INTO medecins( id,`nom`, `postnom`, `prenom`, `genre`, `telephone`, `adresse`) VALUES (?,?,?,?,?,?,?)");
            $resultat = $req->execute(['NULL', $nom, $postnom, $prenom, $genre, $telephone, $adresse]);

            // If yes, the result variable will return true, so there was a registration
            if ($resultat == true) {
                $_SESSION['msg'] = "Enregistrement a réussie"; // This line allows you to add a message to the session When there has been a registration
                header("location:../../views/medecin.php");
            } else {
                $_SESSION['msg'] = "Echec d'enregistrement"; // This line allows you to add a message to the session When there has been a registration
                header("location:../../views/medecin.php");
            }
        } else {
            $_SESSION['msg'] = "Le numero de téléphone ne doit pas être une chaîne de caractère";
            header("location:../../views/medecin.php");
        }
    }
} else {
    // This line allows you to redirect the user when they have not clicked the button that is used to save
    header("location:../../views/medecin.php");
}
