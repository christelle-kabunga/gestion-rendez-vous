<?php 
include("../../connexion/connexion.php");

if(isset($_POST['valider'])&& !empty($_GET['edit'])){
    $idmodif=$_GET['edit'];
    $description = htmlspecialchars($_POST['description']);
    $date = htmlspecialchars($_POST['date']);

      // Check if the consultation already exists in the database
      $getpatDeplicant = $connexion->prepare("SELECT * FROM consultation WHERE description=?  and supprimer=?");
      $getpatDeplicant->execute([$description, 0]);
      $tab = $getpatDeplicant->fetch();
    if ($tab > 0) {
      $_SESSION['msg'] = "Ce consultation existe dejà dans la base de données !"; //Cette variable recoit le message pour notifier l'utilisateur de l'opération qu'il deja fait
      header("location:../../views/consultation.php?edit=" . $id);
    } else {

    $req=$connexion->prepare("UPDATE consultation SET description=?, date=? where id='$idmodif'");
    $exe=$req->execute([$description,$date]);
    if($exe==true){
        $msg="Modification réussie";
        $_SESSION['msg']=$msg;
        header("location:../../views/consultation.php");
    }
    }
}else{
    header("location:../../views/consultation.php");
}
?>