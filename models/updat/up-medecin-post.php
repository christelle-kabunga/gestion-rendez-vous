<?php 
include("../../connexion/connexion.php");

if(isset($_POST['valider'])&& !empty($_GET['edit'])){
    $idmodif=$_GET['edit'];
    // recuperer l'image
    $image = $_FILES['photo']['name'];
    $file = $_FILES['photo'];
    $destination = "img/" . basename($image);
// fonction permettant de recuperer la photo
    $newimage = RecuperPhoto($image, $file, $destination);
    $description = htmlspecialchars($_POST['description']);
    $nom=htmlspecialchars($_POST['nom']);
    $postnom = htmlspecialchars($_POST['postnom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $genre = htmlspecialchars($_POST['genre']);
    $adresse = htmlspecialchars($_POST['adresse']);
    $telephone = htmlspecialchars($_POST['telephone']);
    $pwd = htmlspecialchars($_POST['pwd']);

    $getmedecins = $connexion->prepare("SELECT * FROM medecins WHERE telephone=? AND supprimer=?");
    $getmedecins->execute([$medecins, 0]);
    $tab = $getmedecins->fetch();
    if ($tab > 0) {
      $_SESSION['msg'] = "Ce medecin existe dejà dans la base de données !"; //Cette variable recoit le message pour notifier l'utilisateur de l'opération qu'il deja fait
      header("location:../../views/medecin.php?edit=" . $id);
    } else {

if(is_numeric($telephone)){
    $req=$connexion->prepare("UPDATE medecins SET nom=?, postnom=?, prenom=?, genre=?,adresse=?, telephone=?,photo=?,description=?,pwd=? where id='$idmodif'");
    $exe=$req->execute([$nom,$postnom,$prenom,$genre,$adresse,$telephone,$newimage,$description,$pwd]);
    if($exe==true){
        $msg="Modification réussie";
        $_SESSION['msg']=$msg;
        header("location:../../views/medecin.php");
    }

}else{
        $_SESSION['mss']="le numero de telephone ne doit pas être un texte";
        header("location:../../views/medecin.php");
    }
    }
}else{
    header("location:../../views/medecin.php");
}
?>