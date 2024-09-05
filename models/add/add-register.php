<?php 
include '../../connexion/connexion.php'; // Connexion à la base de données

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = htmlspecialchars($_POST['nom']);
    $postnom = htmlspecialchars($_POST['postnom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $telephone = htmlspecialchars($_POST['telephone']);
    $adresse = htmlspecialchars($_POST['adresse']);
    $genre = htmlspecialchars($_POST['genre']);
    $pwd = htmlspecialchars($_POST['pwd']);
    $id_medecin = htmlspecialchars($_GET['id']); // Récupérer l'ID du médecin depuis l'URL
    $id_medecin=htmlspecialchars($_POST["id_medecin"]);

    try {
        // Début de la transaction
        $connexion->beginTransaction();

        // Insertion dans la table patients
        $stmt = $connexion->prepare("INSERT INTO patients (nom, postnom, prenom, genre, telephone, adresse, pwd, supprimer) VALUES (?, ?, ?,?,?,?,?)");
        $stmt->execute([$nom, $postnom, $prenom,$genre, $telephone,$adresse, $pwd,0]);

        // Récupérer l'ID du patient inséré
        $id_patient = $connexion->lastInsertId();

        // Insertion dans la table rendez_vous
        $stmt_rdv = $connexion->prepare("INSERT INTO rendez_vous (patient, medecin, date, etat, supprimer) VALUES (?, ?, NOW(), 0, 0)");
        $stmt_rdv->execute([$id_patient, $id_medecin]);

        // Valider la transaction
        $connexion->commit();

        $_SESSION['msg'] = "Inscription réussie et rendez-vous pris.";
        header("Location: ../../views/inscription.php");
    } catch (Exception $e) {
        // En cas d'erreur, annuler la transaction
        $connexion->rollBack();
        $_SESSION['msg'] = "Une erreur s'est produite: " . $e->getMessage();
        header("Location: ../../views/inscription.php");
    }
}
?>
