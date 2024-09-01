<?php
    if (isset($_GET['edit']) && !empty($_GET['edit'])){
     $id=$_GET['edit'];
     $getDataMod=$connexion->prepare("SELECT consultation.description,consultation.id,rendez_vous.patient as idp,patients.nom as nompatient,patients.postnom as postnompatient,medecins.nom as nommedecin,medecins.postnom as postnommedecin,rendez_vous.medecin as idm,consultation.rendez FROM consultation,patients,medecins,rendez_vous WHERE rendez_vous.patient=patients.id AND medecins.id=rendez_vous.medecin and rendez_vous.id=consultation.rendez and consultation.supprimer=0 AND patients.supprimer=0 and medecins.supprimer=0 AND rendez_vous.supprimer and id=?");
     $getDataMod->execute([$id]);
     $tab=$getDataMod->fetch();
    
     $url="../models/updat/up-consultation-post.php?edit=".$id;//Cette varible permet de savoir sur quelle page l'action va etre executée lors de la modification
     $btn="Modifier";//On chager le texte sur le button qui sert à modifier ou ajouter
     $title="Modifier consultation";
    }
    else{
     $url="../models/add/add-consultation-post.php";//Cette varible permet de savoir sur quelle page l'action va etre executée lors de l'enregistrement. il sera mit dans l'attribut action dans le form
     $btn="Enregistrer";//On chager le texte sur le button qui sert à modifier ou ajouter
     $title="Ajouter consultation";
    }

    #La requette qui permet de faire les affichages et recherche
    if(isset($_GET['search']) && !empty($_GET['search'])){
        $search=$_GET['search'];
        $getData=$connexion->prepare("SELECT * from consultation WHERE supprimer=? AND nom LIKE ? OR postnom LIKE ? OR prenom LIKE ? 
        OR genre LIKE ? OR adresse LIKE ? OR telephone LIKE ?");
        $getData->execute([0,  $search."%", $search."%", $search."%", $search."%", $search."%", $search."%"]);
    }
    else{
        $getData=$connexion->prepare("SELECT * from consultation WHERE supprimer=?");
        $getData->execute([0]);
    }