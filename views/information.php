<?php 
    include '../connexion/connexion.php';//Se connecter à la BD
    #Appel de la page qui permet de faire les affichages
    require_once('../models/select/select-information.php');
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <?php require_once('style.php'); ?>
    <title>information</title>
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
            <h1>Ajouter Informations</h1>
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
                <div class=" row card-body">
                  <div class="form-group col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                    <label for="exampleInputEmail1">Titre</label>
                    <input type="text"  autocomplete="off" required type="text" class="form-control" placeholder="Ex: information" name="titre"
                    <?php if (isset($_GET['edit'])) { ?> value="<?php echo $tab['nom']; ?> <?php }?>">
                  </div>
                  <div class="form-group col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                    <label for="exampleInputEmail1">Contenu</label>
                    <input type="text"  autocomplete="off" required type="text" class="form-control" placeholder="Ex: KKKKKKK" name="contenu"
                    <?php if (isset($_GET['edit'])) { ?> value="<?php echo $tab['nom']; ?> <?php }?>">
                  </div>
                  <div class="form-group col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                    <label for="exampleInputEmail1">Photo</label>
                    <input  autocomplete="off" required type="file" class="form-control" placeholder=""
                                    name="photo" <?php if (isset($_GET['edit'])) { ?>
                                    value="<?php echo $tab['postnom']; ?> <?php }?>">
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
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>N°</th>
                  <th>Titre</th>
                  <th>Contenu</th>
                  <th>Photo</th>
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
                  <td><?=$recup["titre"];?></td>
                  <td> <?=$recup["contenu"];?></td>
                  <td><img src="../models/add/img/<?= $recup["photo"] ?>" width='50' height="50"
                                        style="object-fit: cover;"></td>
                  <td>
                  <a href='information.php?edit=<?=$recup['id'] ?>' class="btn btn-info btn-sm "><i
                    class="bi bi-pencil-square"></i></a>
                  <a onclick=" return confirm('Voulez-vous vraiment supprimer ?')"
                  href='../models/delete/del-information-post.php?idSup=<?=$recup['id'] ?>'
                    class="btn btn-danger btn-sm "><i class="bi bi-trash3-fill"></i></a>                            
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