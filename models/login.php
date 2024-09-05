<?php
session_start();
include('../connexion/connexion.php');

if (isset($_POST['connect'])) {
    $username = htmlspecialchars($_POST['username']);
    $pwd = htmlspecialchars($_POST['pwd']);

    // Vérification des informations de connexion pour l'medecin
    $recupmedecin = $connexion->prepare("SELECT * FROM medecins WHERE nom = ? AND `pwd` = ?");
    $recupmedecin->execute([$username, $pwd]);

    // Vérification des informations de connexion pour le patient
    $recupens = $connexion->prepare("SELECT * FROM patients WHERE nom = ? AND `pwd` = ?");
    $recupens->execute([$username, $pwd]);

    // Vérification des informations de connexion pour l'admin
    $recupadmin = $connexion->prepare("SELECT * FROM admin WHERE nom = ? AND `pwd` = ?");
    $recupadmin->execute([$username, $pwd]);

    // Si un médecin est trouvé
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

    // Si un patient est trouvé
    } elseif ($ens = $recupens->fetch()) {
        $_SESSION["patient"] = $ens['id'];
        $_SESSION["noms"] = $ens['nom'] . ' ' . $ens['postnom'];
        $_SESSION["nom"] = $ens['nom'];
        $_SESSION['prenom'] = $ens['prenom'];
        $_SESSION['telephone'] = $ens['telephone'];
        $_SESSION['genre'] = $ens['genre'];
        $_SESSION['postnom'] = $ens['postnom'];
        $_SESSION['patient_role'] = "patient";
        header("Location: ../views/resultatp.php");
        exit();

    // Si un admin est trouvé
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

    // Si aucune correspondance n'est trouvée
    } else {
        $_SESSION['msg'] = "Nom d'utilisateur ou mot de passe incorrect";
        
        // Redirection vers la page info.php pour les patients sans compte
        header("Location: ../views/info.php");
        exit();
    }
}
?>
