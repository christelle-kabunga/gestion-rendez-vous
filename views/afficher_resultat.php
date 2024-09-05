<?php
session_start();
include '../connexion/connexion.php';  // Inclusion de la connexion à la base de données

// Vérifier si le médecin est connecté
if(isset($_SESSION["medecin"])) {
    $idm = $_SESSION['medecin'];  // ID du médecin connecté
} else {
    // Si aucun médecin n'est connecté, redirection vers la page de connexion
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once('style.php'); ?>  <!-- Inclusion des styles -->
    <title>Résultats des Patients</title>
</head>
<body>
    <!-- Appel du menu -->
    <?php require_once('aside.php'); ?>

    <div class="content-wrapper">
        <!-- Content Header -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Résultats des Patients</h1>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>Nom du Patient</th>
                                            <th>Postnom du Patient</th>
                                            <th>Date de la Prescription</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Requête pour récupérer les prescriptions associées au médecin connecté via la table rendez_vous
                                        $query = $connexion->prepare("
                                            SELECT prescription.id AS prescription_id, 
                                                   patients.nom AS nom_patient, 
                                                   patients.postnom AS postnom_patient,
                                                   prescription.date AS date_prescription
                                            FROM prescription
                                            JOIN patients ON prescription.patient = patients.id
                                            JOIN rendez_vous ON prescription.patient = rendez_vous.patient
                                            WHERE prescription.supprimer = 0 
                                              AND patients.supprimer = 0
                                              AND rendez_vous.medecin = ?  -- Filtrer par l'ID du médecin connecté
                                        ");
                                        $query->execute([$idm]);  // Passer l'ID du médecin connecté dans la requête

                                        $n = 0;
                                        while ($row = $query->fetch()) {
                                            $n++;
                                            ?>
                                            <tr>
                                                <td><?=$n;?></td>
                                                <td><?=$row['nom_patient'];?></td>
                                                <td><?=$row['postnom_patient'];?></td>
                                                <td><?=$row['date_prescription'];?></td>
                                                <td>
                                                    <a href='resultat.php?prescription_id=<?=$row['prescription_id'];?>' class="btn btn-primary btn-sm">Voir Résultat</a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <?php require_once('script.php'); ?>  <!-- Inclusion des scripts -->
</body>
</html>
