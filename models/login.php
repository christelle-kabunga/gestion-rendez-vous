<?php
include('../connexion/connexion.php');

if (isset($_POST['connect'])) {
    $username = htmlspecialchars($_POST['username']);
    $pwd = htmlspecialchars($_POST['pwd']);

    // Vérification des informations de connexion pour l'medecin
    $recupmedecin = $connexion->prepare("SELECT * FROM medecins WHERE nom = ? AND `pwd` = ?");
    $recupmedecin->execute([$username, $pwd]);

    // Vérification des informations de connexion pour l'patient
    $recupens = $connexion->prepare("SELECT * FROM patients WHERE nom = ? AND `pwd` = ?");
    $recupens->execute([$username, $pwd]);

    // Vérification des informations de connexion pour le admin
    $recupadmin = $connexion->prepare("SELECT * FROM admin WHERE nom = ? AND `pwd` = ?");
    $recupadmin->execute([$username, $pwd]);

    if ($medecin = $recupmedecin->fetch()) {
        $_SESSION["medecin"] = $medecin['id'];
        $_SESSION["noms"] = $medecin['nom'] . ' ' . $medecin['postnom'];
        $_SESSION["nom"] = $medecin['nom'];
        $_SESSION['prenom'] = $medecin['prenom'];
        $_SESSION['telephone'] = $medecin['telephone'];
        $_SESSION['genre'] = $medecin['genre'];
        $_SESSION['postnom'] = $medecin['postnom'];
        header("Location: ../views/consultation.php");
        exit();
    } elseif ($ens = $recupens->fetch()) {
        $_SESSION["patient"] = $ens['id'];
        $_SESSION["noms"] = $ens['nom'] . ' ' . $ens['postnom'];
        $_SESSION["nom"] = $ens['nom'];
        $_SESSION['prenom'] = $ens['prenom'];
        $_SESSION['telephone'] = $ens['telephone'];
        $_SESSION['genre'] = $ens['genre'];
        $_SESSION['postnom'] = $ens['postnom'];
        $_SESSION['patient_role'] = "patient";
        header("Location: ../views/resultat.php");
        exit();
    } elseif ($admin = $recupadmin->fetch()) {
        $_SESSION["admin"] = $admin['id'];
        $_SESSION["noms"] = $admin['nom'] . ' ' . $admin['postnom'];
        $_SESSION["nom"] = $admin['nom'];
        $_SESSION['prenom'] = $admin['prenom'];
        $_SESSION['telephone'] = $admin['telephone'];
        $_SESSION['genre'] = $admin['genre'];
        $_SESSION['postnom'] = $admin['postnom'];
        $_SESSION['role'] = "admin";
        header("Location: ../views/information.php");
        exit();
    } else {
        $_SESSION['msg'] = "Nom d'utilisateur ou mot de passe incorrect";
        header("Location: ../views/index.php");
        exit();
    }
}
?>
