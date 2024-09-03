<?php
include('../../connexion/connexion.php');

if (isset($_POST['valider'])) {
    $description = htmlspecialchars($_POST['description']);
    $patientId = htmlspecialchars($_POST['patient']);
    $date = date("Y-m-d");

    // Check if the consultation already exists in the database
    $getpatDeplicant = $connexion->prepare("SELECT * FROM consultation WHERE description=? and supprimer=?");
    $getpatDeplicant->execute([$description, 0]);
    $tab = $getpatDeplicant->fetch();

    if ($tab > 0) {
        $_SESSION['msg'] = 'Cette consultation existe déjà dans la base de données';
        header("location:../../views/consultation.php");
    } else {
        // Insert the new consultation with the patient ID
        $req = $connexion->prepare("INSERT INTO consultation (id, description, date, patient) VALUES (NULL, ?, ?, ?)");
        $resultat = $req->execute([$description, $date, $patientId]);

        if ($resultat == true) {
            $_SESSION['msg'] = "Enregistrement réussie";
            header("location:../../views/consultation.php");
        } else {
            $_SESSION['msg'] = "Echec d'enregistrement";
            header("location:../../views/consultation.php");
        }
    }
}

?>
