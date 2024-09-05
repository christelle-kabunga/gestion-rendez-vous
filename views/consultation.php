<?php 
    include '../connexion/connexion.php';//Se connecter à la BD
    #Appel de la page qui permet de faire les affichages
    require_once('../models/select/select-consultation.php');

 
include '../connexion/connexion.php'; // Connexion à la BD

?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <?php require_once('style.php'); ?>
    <title>consultation</title>
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
            <h1>Ajouter consultations</h1>
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
              <!-- form start -->
              <form role="form" class="card p-3" action="<?=$url?>" method="POST" enctype="multipart/form-data">
    <div class="row card-body">
        <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-6 p-3">
            <label for="exampleInputEmail1">Description</label>
            <textarea type="text" autocomplete="off" required class="form-control" placeholder="Ex: consultation" name="description">
                <?php if (isset($_GET['edit'])) { echo $tab['description']; } ?>
            </textarea>
        </div>
        <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-6 p-3">
            <label>Patients</label>
            <select class="form-control select2" required name="patient" autocomplete="off" style="width: 100%;">
                <?php 
                    $req = $connexion->prepare("SELECT * from patients where supprimer=0");
                    $req->execute();
                    while($rendez = $req->fetch()){ 
                        $id = $rendez['id'];
                        $selected = (isset($_GET['edit']) && $id == $tab['idp']) ? 'selected' : ''; 
                        echo "<option value='".$id."' $selected>".$rendez['nom']." ".$rendez['postnom']."</option>";
                    }
                ?>
            </select>
        </div>
    </div>
    <div class="col-xl-12 col-lg-12 col-md-12 mt-10 col-sm-12 p-3 align-center">
        <input type="submit" class="btn btn-dark w-100" name="valider" value="<?=$btn?>">
    </div>
</form>

            </div>
            <!-- /.card -->
            <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>N°</th>
                  <th>Date</th>
                  <th>Description</th>
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
                  <td><?=$recup["date"];?></td>
                  <td> <?=$recup["description"];?></td>
                  <td>
                  <a href='consultation.php?edit=<?=$recup['id'] ?>' class="btn btn-info btn-sm "><i
                     class="fas fa-edit"></i></a></a>
                  <a onclick=" return confirm('Voulez-vous vraiment supprimer ?')"
                  href='../models/delete/del-consultation-post.php?idSup=<?=$recup['id'] ?>'
                    class="btn btn-danger btn-sm "><i class="fas fa-trash"></i></a>                            
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