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
            <h1>Ajouter les Rendez-vous</h1>
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
              <form role="form" class="card p-3" action="<?=$url?>" method="POST">
                <div class=" row card-body">
                  <div class="form-group col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                  <label>patients</label>
                  <select class="form-control select2" required id="" name="patient" autocomplete="off" 
                  style="width: 100%;" value="<?php echo $tab['patient']; ?> ">
                  <?php 
                        $req=$connexion->prepare("SELECT * from patients where supprimer=0");
                        $req->execute();
                        while($rendez=$req->fetch()){ 
                            $id=$rendez['id'];
                                    
                            ?>
                             <?php if (isset($_GET['edit'])) { ?>
                                <option <?php if($id==$tab['patient']) {?> selected value="<?php echo $rendez['id']; ?>"><?php echo  $rendez['nom']." ".$rendez['postnom']; ?><?php } else { ?> value="<?php echo $rendez['id']; ?>"><?php echo  $rendez['nom']." ".$rendez['postnom'];} ?></option>

                             <?php } else {?>  

                        <option value="<?php echo $rendez['id']; ?>"><?php echo  $rendez['nom']." ".$rendez['postnom']; ?></option>
                        <?php }?>
                        <?php 

                            }

                            ?>
                  </select>
                </div>
                  <div class="form-group col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                  <label>Medecins</label>
                  <select class="form-control select2" required id="" name="medecin" autocomplete="off" style="width: 100%;">
                  <?php 
                        $query=$connexion->prepare("SELECT * from medecins where supprimer=0");
                        $query->execute();
                        while($rendez=$query->fetch()){ 
                            $id=$rendez['id'];
                                    
                            ?>
                             <?php if (isset($_GET['edit'])) { ?>
                                <option <?php if($id==$tab['patient']) {?> selected value="<?php echo $rendez['id']; ?>"><?php echo  $rendez['nom']." ".$rendez['postnom']; ?><?php } else { ?> value="<?php echo $rendez['id']; ?>"><?php echo  $rendez['nom']." ".$rendez['postnom'];} ?></option>

                             <?php } else {?>  

                        <option value="<?php echo $rendez['id']; ?>"><?php echo  $rendez['nom']." ".$rendez['postnom']; ?></option>
                        <?php }?>
                        <?php 

                            }

                            ?>
                  </select>
                </div>
                  <div class="form-group col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                    <label for="exampleInputEmail1">Date</label>
                    <input autocomplete="off" required type="date" class="form-control" placeholder=""
                                    name="date" <?php if (isset($_GET['edit'])) { ?>
                                    value="<?php echo $tab['date']; ?> <?php }?>">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="col-xl-12 col-lg-12 col-md-12 mt-10 col-sm-12 p-3 aling-center">
                   <input type="submit" class="btn btn-dark w-100" name="valider" value="<?=$btn?>">
                 </div>
              </form>
            </div>
            <!-- /.card -->
            <div class="card">
            <!-- /.card-header -->
             <h5 class="text-center">Liste des rendez-vous</h5>
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
                  <a href='rendez-vous.php?edit=<?=$recup['id'] ?>' class="btn btn-info btn-sm "><i
                    class="fas fa-edit"></i></a>
                  <a onclick=" return confirm('Voulez-vous vraiment supprimer ?')"
                  href='../models/delete/del-rendez-vous-post.php?idSup=<?=$recup['id'] ?>'
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