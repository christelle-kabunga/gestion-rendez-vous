<?php
// Vérifiez si un médecin est connecté
if (isset($_SESSION['medecin'])) {
    $idm = $_SESSION['medecin'];  // Récupération de l'ID du médecin connecté
} else {
    header("Location: login.php");  // Redirection si aucun médecin n'est connecté
    exit();
}
if (isset($_GET['edit']) && !empty($_GET['edit'])) {
    $id = $_GET['edit'];
    
    $getDataMod=$connexion->prepare("SELECT * FROM prescription WHERE id=?");
    $getDataMod->execute([$id]);
    $tab=$getDataMod->fetch();    

    $url = "../models/updat/up-prescription-post.php?edit=" . $id;
    $btn = "Modifier";
} else {
    $url = "../models/add/add-prescription-post.php";
    $btn = "Enregistrer";
}

// Requête pour récupérer toutes les prescriptions
$getData = $connexion->prepare("SELECT prescription.*, patients.nom AS nom_patient, patients.postnom AS postnom_patient 
FROM prescription 
JOIN patients ON prescription.patient = patients.id 
WHERE prescription.supprimer = 0 and prescription.medecin=? AND patients.supprimer = 0");
$getData->execute([$idm]);
?>
