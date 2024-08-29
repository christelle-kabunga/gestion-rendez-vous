<?php 
 include('../../connexion/connexion.php');
 if(isset($_GET['idSup']) && !empty($_GET['idSup'])){
    $id=$_GET['idSup'];
    $supprimer=1;

    $req=$connexion->prepare("UPDATE rendez_vous set supprimer=? where id=?");
    $exe=$req->execute([$supprimer,$id]);

    if($exe==true){
        $_SESSION['msd']=" Suppression réussie";
        header("location:../../views/rendez-vous.php");
    }
 }else{
    header("location:../../views/rendez-vous.php");
 }

?>