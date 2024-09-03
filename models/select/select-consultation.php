<?php
    if (isset($_GET['edit']) && !empty($_GET['edit'])){
        $id = $_GET['edit'];
        $getDataMod = $connexion->prepare("SELECT consultation.description, consultation.id, rendez_vous.patient as idp, patients.nom as nompatient, patients.postnom as postnompatient, medecins.nom as nommedecin, medecins.postnom as postnommedecin, rendez_vous.medecin as idm, consultation.rendez 
        FROM consultation 
        JOIN patients ON rendez_vous.patient = patients.id 
        JOIN medecins ON medecins.id = rendez_vous.medecin 
        JOIN rendez_vous ON rendez_vous.id = consultation.rendez 
        WHERE consultation.supprimer = 0 AND patients.supprimer = 0 AND medecins.supprimer = 0 AND rendez_vous.supprimer = 0 AND consultation.id = ?");
        $getDataMod->execute([$id]);
        $tab = $getDataMod->fetch();
    
        $url = "../models/updat/up-consultation-post.php?edit=".$id;
        $btn = "Modifier";
        $title = "Modifier consultation";
    } else {
        $url = "../models/add/add-consultation-post.php";
        $btn = "Enregistrer";
        $title = "Ajouter consultation";
    }
    
    // Fetch all consultations if no search term is provided
    $getData = $connexion->prepare("SELECT * FROM consultation WHERE supprimer = ?");
    $getData->execute([0]);
    