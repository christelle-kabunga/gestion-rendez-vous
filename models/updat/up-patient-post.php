<?php 
include("../../connexion/connexion.php");

if(isset($_POST['valider'])&& !empty($_GET['edit'])){
    $idmodif=$_GET['edit'];
    $nom=htmlspecialchars($_POST['nom']);
    $postnom = htmlspecialchars($_POST['postnom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $genre = htmlspecialchars($_POST['genre']);
    $adresse = htmlspecialchars($_POST['adresse']);
    $telephone = htmlspecialchars($_POST['telephone']);

    $getpatients = $connexion->prepare("SELECT * FROM patients WHERE telephone=? AND supprimer=?");
    $getpatients->execute([$patients, 0]);
    $tab = $getpatients->fetch();
    if ($tab > 0) {
      $_SESSION['msg'] = "Ce patient existe dejà dans la base de données !"; //Cette variable recoit le message pour notifier l'utilisateur de l'opération qu'il deja fait
      header("location:../../views/patient.php?edit=" . $id);
    } else {

if(is_numeric($telephone)){
    $req=$connexion->prepare("UPDATE patients SET nom=?, postnom=?, prenom=?, genre=?,adresse=?, telephone=? where id='$idmodif'");
    $exe=$req->execute([$nom,$postnom,$prenom,$genre,$adresse,$telephone]);
    if($exe==true){
        $msg="Modification réussie";
        $_SESSION['msg']=$msg;
        header("location:../../views/patient.php");
    }

}else{
        $_SESSION['mss']="le numero de telephone ne doit pas être un texte";
        header("location:../../views/patient.php");
    }
    }
}else{
    header("location:../../views/patient.php");
}
?>