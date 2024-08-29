<?php 
include("../../connexion/connexion.php");

if(isset($_POST['valider'])&& !empty($_GET['edit'])){
    $idmodif=$_GET['edit'];
    $patient = htmlspecialchars($_POST['patient']);
    $medecin = htmlspecialchars($_POST['medecin']);
    $date = htmlspecialchars($_POST['date']);

      // Check if the rendez-vous already exists in the database
      $getpatDeplicant = $connexion->prepare("SELECT * FROM rendez_vous WHERE patient=? AND medecin=? and supprimer=?");
      $getpatDeplicant->execute([$patient,$medecin, 0]);
      $tab = $getpatDeplicant->fetch();
    if ($tab > 0) {
      $_SESSION['msg'] = "Ce rendez-vous existe dejà dans la base de données !"; //Cette variable recoit le message pour notifier l'utilisateur de l'opération qu'il deja fait
      header("location:../../views/rendez-vous.php?edit=" . $id);
    } else {

    $req=$connexion->prepare("UPDATE rendez_vous SET patient=?, medecin=?, date=? where id='$idmodif'");
    $exe=$req->execute([$patient,$medecin,$date]);
    if($exe==true){
        $msg="Modification réussie";
        $_SESSION['msg']=$msg;
        header("location:../../views/rendez-vous.php");
    }
    }
}else{
    header("location:../../views/rendez-vous.php");
}
?>