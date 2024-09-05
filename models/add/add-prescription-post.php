<?php
include('../../connexion/connexion.php');

if (isset($_POST['valider'])) {
    // Récupérer les valeurs du formulaire
    $description = htmlspecialchars($_POST['description']);
    $date = date("Y-m-d");
    $patientId = htmlspecialchars($_POST['patient']);
    $medicamentId = htmlspecialchars($_POST['medicament']);
    $dosage = htmlspecialchars($_POST['dosage']);
    $duree = htmlspecialchars($_POST['duree']);
    $consultation = $_POST['consultation'];
    $resultat = $_POST['resultat'];
    $medecin = $_SESSION['medecin'];  // ID du médecin connecté

    // Vérifier si la prescription existe déjà
    $getPrescription = $connexion->prepare("SELECT * FROM prescription WHERE description=? AND patient=? AND supprimer=0");
    $getPrescription->execute([$description, $patientId]);
    $tab = $getPrescription->fetch();

    if ($tab) {
        $_SESSION['msg'] = 'Cette prescription existe déjà dans la base de données';
        header("location:../../views/prescription.php");
    } else {
        // Insérer la nouvelle prescription
        $req = $connexion->prepare("INSERT INTO prescription (description, date, patient,consultation, medicament, dosage, duree,resultat) VALUES (?, ?, ?, ?, ?, ?,?,?)");
        $requete = $req->execute([$description, $date, $patientId,$consultation, $medicamentId, $dosage, $duree,$resultat]);

        if ($requete) {
            $_SESSION['msg'] = "Enregistrement réussi";
        } else {
            $_SESSION['msg'] = "Échec de l'enregistrement";
        }

        header("location:../../views/prescription.php");
    }
} else {
    // Redirection si le formulaire n'est pas soumis
    header("location:../../views/prescription.php");
}
?>
