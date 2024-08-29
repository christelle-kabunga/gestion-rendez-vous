<?php
    if (isset($_GET['edit']) && !empty($_GET['edit'])){
     $id=$_GET['edit'];
     $getDataMod=$connexion->prepare("SELECT * FROM rendez_vous WHERE id=?");
     $getDataMod->execute([$id]);
     $tab=$getDataMod->fetch();
    
     $url="../models/updat/up-rendez-vous-post.php?edit=".$id;//Cette varible permet de savoir sur quelle page l'action va etre executée lors de la modification
     $btn="Modifier";//On chager le texte sur le button qui sert à modifier ou ajouter
     $title="Modifier rendez-vous";
    }
    else{
     $url="../models/add/add-rendez-vous-post.php";//Cette varible permet de savoir sur quelle page l'action va etre executée lors de l'enregistrement. il sera mit dans l'attribut action dans le form
     $btn="Enregistrer";//On chager le texte sur le button qui sert à modifier ou ajouter
     $title="Ajouter rendez-vous";
    }

    #La requette qui permet de faire les affichages et recherche
    if(isset($_GET['search']) && !empty($_GET['search'])){
        $search=$_GET['search'];
        $getData=$connexion->prepare("SELECT * from rendez_vous WHERE supprimer=? AND nom LIKE ? OR postnom LIKE ? OR prenom LIKE ? 
        OR genre LIKE ? OR adresse LIKE ? OR telephone LIKE ?");
        $getData->execute([0,  $search."%", $search."%", $search."%", $search."%", $search."%", $search."%"]);
    }
    else{
        $getData=$connexion->prepare("SELECT rendez_vous.id,patients.nom as nom_patient,patients.postnom as postnom_patient,medecins.nom as nom_medecin,medecins.postnom as postnom_medecin,rendez_vous.date as date FROM patients,medecins,rendez_vous WHERE patients.id=rendez_vous.patient AND medecins.id=rendez_vous.medecin AND patients.supprimer=0 AND medecins.supprimer=0 AND rendez_vous.supprimer=0 AND rendez_vous.etat=0");
        $getData->execute();
    }