<?php 
include("../../connexion/connexion.php");

if(isset($_POST['valider'])&& !empty($_GET['edit'])){
 // Récupérer les valeurs du formulaire
 $description = htmlspecialchars($_POST['description']);
 $date = date("Y-m-d");
 $patientId = htmlspecialchars($_POST['patient']);
 $medicamentId = htmlspecialchars($_POST['medicament']);
 $dosage = htmlspecialchars($_POST['dosage']);
 $duree = htmlspecialchars($_POST['duree']);
 $consultation = $_POST['consultation'];
 $resultat = $_POST['resultat'];

      // Check if the prescription already exists in the database
      $getpatDeplicant = $connexion->prepare("SELECT * FROM prescription WHERE description=?  and supprimer=?");
      $getpatDeplicant->execute([$description, 0]);
      $tab = $getpatDeplicant->fetch();
    if ($tab > 0) {
      $_SESSION['msg'] = "Cette prescription existe dejà dans la base de données !"; //Cette variable recoit le message pour notifier l'utilisateur de l'opération qu'il deja fait
      header("location:../../views/prescription.php?edit=" . $id);
    } else {

    $req=$connexion->prepare("UPDATE prescription SET description=?,patient=?, consultation=?,medicament=?,dosage=?,duree=?,resultat=?, date=? where id='$idmodif'");
    $exe=$req->execute([$description,$date,$patientId,$consultation,$medicamentId,$dosage,$duree,$resultat]);
    if($exe==true){
        $msg="Modification réussie";
        $_SESSION['msg']=$msg;
        header("location:../../views/prescription.php");
    }
    }
}else{
    header("location:../../views/prescription.php");
}
?>