<?php
if (isset($_GET['edit']) && !empty($_GET['edit'])) {
    $id = $_GET['edit'];
    
    // Requête pour récupérer les données de prescription, patient et consultation
    $getDataMod = $connexion->prepare("SELECT prescription.*, patients.nom AS nom_patient, patients.postnom AS postnom_patient, 
    consultations.date AS date_consultation, consultations.nom_medecin AS nom_medecin
    FROM prescription 
    JOIN patients ON prescription.patient = patients.id 
    JOIN consultations ON prescription.consultation = consultations.id
    WHERE prescription.supprimer = 0 AND patients.supprimer = 0 AND consultations.supprimer = 0 AND prescription.id = ?");
    $getDataMod->execute([$id]);
    $tab = $getDataMod->fetch();    

    $url = "../models/update/up-prescription-post.php?edit=" . $id;
    $btn = "Modifier";
} else {
    $url = "../models/add/add-prescription-post.php";
    $btn = "Enregistrer";
}

// Requête pour récupérer toutes les prescriptions
$getData = $connexion->prepare("SELECT prescription.*, patients.nom AS nom_patient, patients.postnom AS postnom_patient 
FROM prescription 
JOIN patients ON prescription.patient = patients.id 
WHERE prescription.supprimer = 0 AND patients.supprimer = 0");
$getData->execute();
?>
