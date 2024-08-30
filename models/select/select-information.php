<?php
    if (isset($_GET['edit']) && !empty($_GET['edit'])){
     $id=$_GET['edit'];
     $getDataMod=$connexion->prepare("SELECT * FROM information WHERE id=?");
     $getDataMod->execute([$id]);
     $tab=$getDataMod->fetch();
    
     $url="../models/updat/up-information-post.php?edit=".$id;//Cette varible permet de savoir sur quelle page l'action va etre executée lors de la modification
     $btn="Modifier";//On chager le texte sur le button qui sert à modifier ou ajouter
     $title="Modifier information";
    }
    else{
     $url="../models/add/add-information-post.php";//Cette varible permet de savoir sur quelle page l'action va etre executée lors de l'enregistrement. il sera mit dans l'attribut action dans le form
     $btn="Enregistrer";//On chager le texte sur le button qui sert à modifier ou ajouter
     $title="Ajouter information";
    }

    #La requette qui permet de faire les affichages et recherche
    if(isset($_GET['search']) && !empty($_GET['search'])){
        $search=$_GET['search'];
        $getData=$connexion->prepare("SELECT * from information WHERE supprimer=? AND nom LIKE ? OR postnom LIKE ? OR prenom LIKE ? 
        OR genre LIKE ? OR adresse LIKE ? OR telephone LIKE ?");
        $getData->execute([0,  $search."%", $search."%", $search."%", $search."%", $search."%", $search."%"]);
    }
    else{
        $getData=$connexion->prepare("SELECT * from information WHERE supprimer=?");
        $getData->execute([0]);
    }