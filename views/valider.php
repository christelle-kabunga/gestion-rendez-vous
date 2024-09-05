<?php 
    include '../connexion/connexion.php';//Se connecter à la BD
    if(isset($_SESSION["medecin"])) {
        $idm = $_SESSION['medecin'];
    }

if(isset($_GET['confirmer']) && !empty($_GET['confirmer'])){
    $id=$_GET['confirmer'];

    $req=$connexion->prepare("UPDATE rendez_vous SET etat=? where id=?");
    $exe=$req->execute([1,$id]);
    if($exe==true){
        $msg="Vous venez de confirmer ce  rendez-vous";
        $_SESSION['msg']=$msg;
        header("location:valider.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <?php require_once('style.php'); ?>
    <title>Liste des rendez-vous</title>
</head>
<body>
     <!-- Appel de menues  -->
     <?php require_once('aside.php') ?>
     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Liste des rendez-vous</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
   
            <!-- /.card -->
            <div class="card">
                <!-- pour afficher les massage  -->
              <?php
                if(isset($_SESSION['msg']) && !empty($_SESSION['msg'])){
                    ?><div class="alert-info alert text-center"><?=$_SESSION['msg']?></div><?php
                }
                unset($_SESSION['msg']);#Cette ligne permet de vider la valeur qui se trouve dans la session message
            ?>
            <!-- /.card-header -->
             <h5 class="text-center">Liste des rendez-vous</h5>
            <div class="card-body">
              
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>N°</th>
                  <th>Patient</th>
                  <th>Date de rendez-vous</th>
                  <th>Actions</th>
                
                </tr>
                </thead>
                <tbody>
                  <?php
                   $getData=$connexion->prepare("SELECT rendez_vous.id as idr,patients.nom as nom_patient,patients.postnom as postnom_patient,medecins.nom as nom_medecin,medecins.postnom as postnom_medecin,medecins.id as medecin_id,rendez_vous.date as date FROM patients,medecins,rendez_vous WHERE patients.id=rendez_vous.patient AND medecins.id=rendez_vous.medecin AND patients.supprimer=0 AND medecins.supprimer=0 AND rendez_vous.supprimer=0 AND rendez_vous.etat=0 and medecins.id=?");
                   $getData->execute([$idm]);
                  $n=0;
                  while($recup=$getData->fetch()){
                    $n++;
                  ?>
                <tr>
                  <td><?=$n;?></td>
                  <td><?=$recup["nom_patient"]. " ".$recup["postnom_patient"] ;?></td>
                  <td><?=$recup["date"];?></td>
                  <td>
                  <a href='valider.php?confirmer=<?=$recup['idr'] ?>' class="btn btn-info btn-sm ">Valider</a>                           
                  </td>
                </tr>
                <?php }?> 
              </table>
            </div>
            <!-- /.card-body -->
          </div> <br>

          <!-- /.card -->
          <div class="card">
                <!-- pour afficher les massage  -->
              <?php
                if(isset($_SESSION['msg']) && !empty($_SESSION['msg'])){
                    ?><div class="alert-info alert text-center"><?=$_SESSION['msg']?></div><?php
                }
                unset($_SESSION['msg']);#Cette ligne permet de vider la valeur qui se trouve dans la session message
            ?>
            <!-- /.card-header -->
             <h5 class="text-center">Liste des rendez-vous confirmés</h5>
            <div class="card-body">
              
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>N°</th>
                  <th>Patient</th>
                  <th>Date de rendez-vous</th>
                  <th>Actions</th>
                
                </tr>
                </thead>
                <tbody>
                  <?php
                   $getData=$connexion->prepare("SELECT rendez_vous.id as idr,patients.nom as nom_patient,patients.postnom as postnom_patient,medecins.nom as nom_medecin,medecins.postnom as postnom_medecin,medecins.id as medecin_id,rendez_vous.date as date FROM patients,medecins,rendez_vous WHERE patients.id=rendez_vous.patient AND medecins.id=rendez_vous.medecin AND patients.supprimer=0 AND medecins.supprimer=0 AND rendez_vous.supprimer=0 AND rendez_vous.etat=1 and medecins.id=?");
                   $getData->execute([$idm]);
                  $n=0;
                  while($recup=$getData->fetch()){
                    $n++;
                  ?>
                <tr>
                  <td><?=$n;?></td>
                  <td><?=$recup["nom_patient"]. " ".$recup["postnom_patient"] ;?></td>
                  <td><?=$recup["date"];?></td>
                  <td>
                  <a href='valider.php?confirmer=<?=$recup['idr'] ?>' class="btn btn-info btn-sm ">Rappeler le rendez-vous</a>                           
                  </td>
                </tr>
                <?php }?> 
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

    <?php require_once('script.php') ?>
</body>
</html>