<?php 
    include '../connexion/connexion.php';//Se connecter à la BD
    #Appel de la page qui permet de faire les affichages
    require_once('../models/select/select-rendez-vous.php');
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <?php require_once('style.php'); ?>
    <title>Rendez-vous</title>
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
            <h1>Valider rendez-vous</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <!-- pour afficher les massage  -->
              <?php
                if(isset($_SESSION['msg']) && !empty($_SESSION['msg'])){
                    ?><div class="alert-info alert text-center"><?=$_SESSION['msg']?></div><?php
                }
                unset($_SESSION['msg']);#Cette ligne permet de vider la valeur qui se trouve dans la session message
            ?>
              <!-- /.card-header -->
            </div>
            <!-- /.card -->
            <div class="card">
            <!-- /.card-header -->
             <h5 class="text-center">Valider Rendez-vous</h5>
            <div class="card-body">
              
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>N°</th>
                  <th>Patient</th>
                  <th>Medecin</th>
                  <th>Date de rendez-vous</th>
                  <th>Actions</th>
                
                </tr>
                </thead>
                <tbody>
                  <?php
                  $n=0;
                  while($recup=$getData->fetch()){
                    $n++;
                  ?>
                <tr>
                  <td><?=$n;?></td>
                  <td><?=$recup["nom_patient"]. " ".$recup["postnom_patient"] ;?></td>
                  <td> <?=$recup["nom_medecin"]. " ".$recup["postnom_medecin"] ;?></td>
                  <td><?=$recup["date"];?></td>
                  <td>
                  <a href='rendez-vous.php?edit=<?=$recup['id'] ?>' class="btn btn-info btn-sm ">Valider</a>                        
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