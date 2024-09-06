<?php 
include("../../connexion/connexion.php");
require_once ('../../fonctions/fonctions.php');
if(isset($_POST['valider'])&& !empty($_GET['edit'])){
    $idmodif=$_GET['edit'];
  // recuperer l'image
$image = $_FILES['photo']['name'];
$file = $_FILES['photo'];
$destination = "img/" . basename($image);
// fonction permettant de recuperer la photo
    $newimage = RecuperPhoto($image, $file, $destination);
    $titre = htmlspecialchars($_POST['titre']);
    $contenu = htmlspecialchars($_POST['contenu']);
    $date=date("Y-m-d");

    // Check if the information already exists in the database
    $getpatDeplicant = $connexion->prepare("SELECT * FROM information WHERE titre=? AND contenu=? and supprimer=?");
    $getpatDeplicant->execute([$titre,$contenu, 0]);
    $tab = $getpatDeplicant->fetch();

    if ($tab > 0) {
        $_SESSION['msg'] = 'Cette information existe déjà dans la base de données'; // This variable receives the message to notify the user of the operation they have already done
        header("location:../../views/information.php");
    } else {

    $req=$connexion->prepare("UPDATE information SET titre=?, contenu=?, date=?, photo=? where id='$idmodif'");
    $exe=$req->execute([$titre,$contenu,$date,$newimage]);
    if($exe==true){
        $msg="Modification réussie";
        $_SESSION['msg']=$msg;
        header("location:../../views/information.php");
    }
    }
}else{
    header("location:../../views/information.php");
}
?>