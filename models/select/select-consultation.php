<?php


// Vérifiez si un médecin est connecté
if (isset($_SESSION['medecin'])) {
    $idm = $_SESSION['medecin'];  // Récupération de l'ID du médecin connecté
} else {
    header("Location: login.php");  // Redirection si aucun médecin n'est connecté
    exit();
}
    if (isset($_GET['edit']) && !empty($_GET['edit'])){
        $id = $_GET['edit'];
        $getDataMod=$connexion->prepare("SELECT * FROM consultation WHERE id=?");
        $getDataMod->execute([$id]);
        $tab=$getDataMod->fetch();
    
        $url = "../models/updat/up-consultation-post.php?edit=".$id;
        $btn = "Modifier";
        $title = "Modifier consultation";
    } else {
        $url = "../models/add/add-consultation-post.php";
        $btn = "Enregistrer";
        $title = "Ajouter consultation";
    }
    
                // Requête pour récupérer les consultations du médecin connecté
            $getData = $connexion->prepare("
            SELECT consultation.id, consultation.date, consultation.description
            FROM consultation
            WHERE consultation.supprimer = 0
            AND consultation.medecin = ?
            ");
            $getData->execute([$idm]);  // Exécution de la requête avec l'ID du médecin
                