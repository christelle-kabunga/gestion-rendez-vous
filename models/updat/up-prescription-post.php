<?php 
include("../../connexion/connexion.php");

if (isset($_POST['valider']) && !empty($_GET['edit'])) {
    $idmodif = $_GET['edit'];  
    // Récupérer les valeurs du formulaire
    $description = htmlspecialchars($_POST['description']);
    $date = date("Y-m-d");
    $patientId = htmlspecialchars($_POST['patient']);
    $medicamentId = htmlspecialchars($_POST['medicament']);
    $dosage = htmlspecialchars($_POST['dosage']);
    $duree = htmlspecialchars($_POST['duree']);
    $consultation = $_POST['consultation'];
    $resultat = $_POST['resultat'];

    // Check if the prescription already exists in the database
    $getpatDeplicant = $connexion->prepare("SELECT * FROM prescription WHERE description=? AND supprimer=?");
    $getpatDeplicant->execute([$description, 0]);
    $tab = $getpatDeplicant->fetch();

    if ($tab > 0) {
        $_SESSION['msg'] = "Cette prescription existe déjà dans la base de données !";
        header("location:../../views/prescription.php?edit=" . $idmodif);
    } else {
        $req = $connexion->prepare("UPDATE prescription SET description=?, patient=?, consultation=?, medicament=?, dosage=?, duree=?, resultat=?, date=? WHERE id=?");
        $exe = $req->execute([$description, $patientId, $consultation, $medicamentId, $dosage, $duree, $resultat, $date, $idmodif]);

        if ($exe) {
            $_SESSION['msg'] = "Modification réussie";
            header("location:../../views/prescription.php?success=true");
        }
    }
} else {
    header("location:../../views/prescription.php");
}
?>
