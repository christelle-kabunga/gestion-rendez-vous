<?php
include('../../connexion/connexion.php');

if (isset($_POST['valider'])) {

    $nom = htmlspecialchars($_POST['nom']);
    $postnom = htmlspecialchars($_POST['postnom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $telephone = htmlspecialchars($_POST['telephone']);
    $pwd = htmlspecialchars($_POST['pwd']);
   
    // Check if the utilisateur already exists in the database
    $getpatDeplicant = $connexion->prepare("SELECT * FROM utilisateur WHERE telephone=?");
    $getpatDeplicant->execute([$telephone]);
    $tab = $getpatDeplicant->fetch();

    if ($tab > 0) {
        $_SESSION['msg'] = 'Ce utilisateur existe déjà dans la base de données'; // This variable receives the message to notify the user of the operation they have already done
        header("location:../../views/register.php");
    } else {
        // Verify the validity of the phone number
        if (is_numeric($telephone)) {
            $req = $connexion->prepare("INSERT INTO utilisateur( id,`nom`, `postnom`, `prenom`, `telephone`, `pwd`) VALUES (?,?,?,?,?,?)");
            $resultat = $req->execute(['NULL', $nom, $postnom, $prenom, $telephone, $pwd]);

            // If yes, the result variable will return true, so there was a registration
            if ($resultat == true) {
                $_SESSION['msg'] = "L'enregistrement a réussi"; // This line allows you to add a message to the session When there has been a registration
                header("location:../../views/register.php");
            } else {
                $_SESSION['msg'] = "Echec d'enregistrement"; // This line allows you to add a message to the session When there has been a registration
                header("location:../../views/register.php");
            }
        } else {
            $_SESSION['msg'] = "Le numero de téléphone ne doit pas être une chaîne de caractère";
            header("location:../../views/register.php");
        }
    }
} else {
    // This line allows you to redirect the user when they have not clicked the button that is used to save
    header("location:../../views/register.php");
}
