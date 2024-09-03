<?php
// Connectez-vous à la base de données
include '../connexion/connexion.php';

// Assurez-vous que l'ID de la prescription est passé en paramètre
if (isset($_GET['prescription_id']) && !empty($_GET['prescription_id'])) {
    $prescription_id = $_GET['prescription_id'];
    
    // Requête pour récupérer les détails de la prescription
    $query = $connexion->prepare("
        SELECT prescription.*, 
               patients.nom AS nom_patient, 
               patients.postnom AS postnom_patient,
               consultation.date AS date_consultation, 
               medecins.nom AS nom_medecin
        FROM prescription
        JOIN consultation ON prescription.consultation = consultation.id
        JOIN rendez_vous ON prescription.patient = rendez_vous.id
        JOIN patients ON rendez_vous.patient = patients.id
        JOIN medecins ON rendez_vous.medecin = medecins.id
        WHERE prescription.id = ? 
          AND prescription.supprimer = 0 
          AND patients.supprimer = 0 
          AND consultation.supprimer = 0 
          AND medecins.supprimer = 0
          AND rendez_vous.supprimer = 0
    ");
    $query->execute([$prescription_id]);
    $result = $query->fetch();

    if ($result) {
        // Début du rapport avec marge en haut
        echo "<div style='max-width: 800px; margin: 40px auto; padding: 20px; border: 1px solid #ddd; background-color: #f9f9f9;'>";
        echo "<h2 style='text-align: center; color: #333;'>Résultats de la Prescription</h2>";
        echo "<hr>";

        // Informations sur le patient
        echo "<h3 style='color: #555;'>Informations sur le Patient</h3>";
        echo "<table style='width: 100%; margin-bottom: 20px; border-collapse: collapse;'>";
        echo "<tr><td style='padding: 8px; border: 1px solid #ddd;'><strong>Patient:</strong></td><td style='padding: 8px; border: 1px solid #ddd;'>" . htmlspecialchars($result['nom_patient']) . " " . htmlspecialchars($result['postnom_patient']) . "</td></tr>";
        echo "<tr><td style='padding: 8px; border: 1px solid #ddd;'><strong>Date de la Consultation:</strong></td><td style='padding: 8px; border: 1px solid #ddd;'>" . htmlspecialchars($result['date_consultation']) . "</td></tr>";
        echo "<tr><td style='padding: 8px; border: 1px solid #ddd;'><strong>Médecin:</strong></td><td style='padding: 8px; border: 1px solid #ddd;'>" . htmlspecialchars($result['nom_medecin']) . "</td></tr>";
        echo "</table>";

        // Informations sur la prescription
        echo "<h3 style='color: #555;'>Détails de la Prescription</h3>";
        echo "<table style='width: 100%; margin-bottom: 20px; border-collapse: collapse;'>";
        echo "<tr><td style='padding: 8px; border: 1px solid #ddd;'><strong>Description:</strong></td><td style='padding: 8px; border: 1px solid #ddd;'>" . htmlspecialchars($result['description']) . "</td></tr>";
        echo "<tr><td style='padding: 8px; border: 1px solid #ddd;'><strong>Résultat:</strong></td><td style='padding: 8px; border: 1px solid #ddd;'>" . htmlspecialchars($result['resultat']) . "</td></tr>";
        echo "<tr><td style='padding: 8px; border: 1px solid #ddd;'><strong>Date de la Prescription:</strong></td><td style='padding: 8px; border: 1px solid #ddd;'>" . htmlspecialchars($result['date']) . "</td></tr>";
        echo "</table>";

        // Bouton pour envoyer le résultat par message
        echo "<div style='text-align: center; margin-top: 20px;'>";
        echo "<a href='send_message.php?prescription_id=" . $prescription_id . "' class='btn btn-success' style='padding: 10px 20px; text-decoration: none; color: white; background-color: #28a745; border-radius: 5px;'>Envoyer comme Message</a>";
        
        // Bouton de retour
        echo "<a href='javascript:history.back()' class='btn btn-secondary' style='padding: 10px 20px; text-decoration: none; color: white; background-color: #6c757d; border-radius: 5px; margin-left: 20px;'>Retour</a>";
        echo "</div>";

        // Fin du rapport
        echo "</div>";
    } else {
        // Message stylisé pour aucun résultat trouvé
        echo "<div style='max-width: 600px; margin: 40px auto; padding: 20px; border: 2px solid #f8d7da; background-color: #f8d7da; color: #721c24; text-align: center; border-radius: 5px;'>";
        echo "<h3 style='margin-bottom: 10px;'>Aucun résultat trouvé pour cette prescription</h3>";
        echo "<p>Il semble que la prescription que vous recherchez n'existe pas ou a été supprimée.</p>";
        echo "<a href='javascript:history.back()' style='padding: 10px 20px; text-decoration: none; color: white; background-color: #007bff; border-radius: 5px;'>Retour</a>";
        echo "</div>";
    }
} else {
    // Message stylisé pour le paramètre manquant
    echo "<div style='max-width: 600px; margin: 40px auto; padding: 20px; border: 2px solid #ffeeba; background-color: #ffeeba; color: #856404; text-align: center; border-radius: 5px;'>";
    echo "<h3 style='margin-bottom: 10px;'>Paramètre manquant : prescription_id</h3>";
    echo "<p>Veuillez fournir un identifiant de prescription valide pour afficher les résultats.</p>";
    echo "<a href='javascript:history.back()' style='padding: 10px 20px; text-decoration: none; color: white; background-color: #007bff; border-radius: 5px;'>Retour</a>";
    echo "</div>";
}
?>
