<?php
include '../connexion/connexion.php';
require_once('../models/select/select-prescription.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once('style.php'); ?>
    <title>Prescriptions</title>
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
                        <h1>Ajouter Prescription</h1>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <!-- Afficher les messages -->
                            <?php
                            if(isset($_SESSION['msg']) && !empty($_SESSION['msg'])) {
                                echo '<div class="alert alert-info text-center">'.$_SESSION['msg'].'</div>';
                                unset($_SESSION['msg']);
                            }
                            ?>

                            <!-- Formulaire pour ajouter/modifier une prescription -->
                            <form role="form" class="card p-3" action="<?=$url?>" method="POST" enctype="multipart/form-data">
                                <div class="row card-body">
                                    <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-6 p-3">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" name="description" required><?php if (isset($_GET['edit'])) { echo htmlspecialchars($tab['description']); } ?></textarea>
                                    </div>

                                    <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-6 p-3">
                                        <label>Patient</label>
                                        <select class="form-control select2" name="patient" required>
                                            <?php
                                            $req = $connexion->prepare("SELECT * FROM patients WHERE supprimer=0");
                                            $req->execute();
                                            while($patient = $req->fetch()) {
                                                $selected = (isset($_GET['edit']) && $patient['id'] == $tab['patient']) ? 'selected' : '';
                                                echo "<option value='".$patient['id']."' $selected>".$patient['nom']." ".$patient['postnom']."</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-6 p-3">
                                        <label for="description">Medicament</label>
                                        <input class="form-control" name="medicament" required value=" <?php if (isset($_GET['edit'])) { echo htmlspecialchars($tab['medicament']); } ?>">
                                    </div>

                                    <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-6 p-3">
                                        <label>Dosage</label>
                                        <input type="text" class="form-control" name="dosage" value="<?php if (isset($_GET['edit'])) { echo htmlspecialchars($tab['dosage']); } ?>" required>
                                    </div>

                                    <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-6 p-3">
                                        <label>Durée</label>
                                        <input type="text" class="form-control" name="duree" value="<?php if (isset($_GET['edit'])) { echo htmlspecialchars($tab['duree']); } ?>" required>
                                    </div>
                                    <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-6 p-3">
                                        <label>Consultation</label>
                                        <select class="form-control select2" name="consultation" required>
                                            <?php
                                            $reqConsultation = $connexion->prepare("SELECT * FROM consultation WHERE supprimer=0");
                                            $reqConsultation->execute();
                                            while($consultation = $reqConsultation->fetch()) {
                                                $selected = (isset($_GET['edit']) && $consultation['id'] == $tab['consultation_id']) ? 'selected' : '';
                                                echo "<option value='".$consultation['id']."' $selected>".$consultation['date']." - ".$consultation['description']."</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-6 p-3">
                                        <label>Resultat</label>
                                        <input type="text" class="form-control" name="resultat" value="<?php if (isset($_GET['edit'])) { echo htmlspecialchars($tab['resultat']); } ?>" required>
                                    </div>
                                </div>

                                <div class="col-xl-12 col-lg-12 col-md-12 mt-10 col-sm-12 p-3 text-center">
                                    <input type="submit" class="btn btn-dark w-100" name="valider" value="<?=$btn?>">
                                </div>
                            </form>
                        </div>

                        <!-- Table des prescriptions -->
                        <div class="card">
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>Date</th>
                                            <th>Description</th>
                                            <th>Patient</th>
                                            <th>Médicament</th>
                                            <th>Dosage</th>
                                            <th>Durée</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $n = 0;
                                        while($recup = $getData->fetch()){
                                            $n++;
                                            ?>
                                            <tr>
                                                <td><?=$n;?></td>
                                                <td><?=$recup["date"];?></td>
                                                <td><?=$recup["description"];?></td>
                                                <td><?=$recup["nom_patient"];?></td>
                                                <td><?=$recup["medicament"];?></td>
                                                <td><?=$recup["dosage"];?></td>
                                                <td><?=$recup["duree"];?></td>
                                                <td>
                                                    <a href='prescription.php?edit=<?=$recup['id'] ?>' class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                                    <a onclick="return confirm('Voulez-vous vraiment supprimer ?')" href='../models/delete/del-prescription.php?idSup=<?=$recup['id'] ?>' class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
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

    <?php require_once('script.php'); ?>
</body>
</html>
