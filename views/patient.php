<?php 
    include '../connexion/connexion.php';//Se connecter à la BD
    #Appel de la page qui permet de faire les affichages
    require_once('../models/select/select-patient.php');
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <?php require_once('style.php'); ?>
    <title>Patients</title>
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
            <h1>Ajouter les Patients</h1>
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
                    <label for="exampleInputEmail1">Nom</label>
                    <input type="text"  autocomplete="off" required type="text" class="form-control" placeholder="Ex: MUHINDO" name="nom"
                    <?php if (isset($_GET['edit'])) { ?> value="<?php echo $tab['nom']; ?> <?php }?>">
                  </div>
                  <div class="form-group col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                    <label for="exampleInputEmail1">PostNom</label>
                    <input type="text"  autocomplete="off" required type="text" class="form-control" placeholder="Ex: MUHINDO" name="postnom"
                    <?php if (isset($_GET['edit'])) { ?> value="<?php echo $tab['nom']; ?> <?php }?>">
                  </div>
                  <div class="form-group col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                    <label for="exampleInputEmail1">PreNom</label>
                    <input  autocomplete="off" required type="text" class="form-control" placeholder="EX: RAFIKI"
                                    name="prenom" <?php if (isset($_GET['edit'])) { ?>
                                    value="<?php echo $tab['postnom']; ?> <?php }?>">
                  </div>
                  <div class="form-group col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                  <label>Genre</label>
                  <select class="form-control select2" required id="" name="genre" autocomplete="off" style="width: 100%;">
                  <?php 
                            if(isset($_GET['edit'])){ 
                               ?>
                                            
                                <?php if($tab['genre']=='Masculin')
                                   {?> 
                    <option value="Masculin" Selected>Masculin</option>
                                               <option value="Feminin">Feminin</option>


                                    <?php     }
                                        else {
                                              ?>  
                                            <option value="Masculin" >Masculin</option>
                                            <option value="Feminin" Selected>Feminin</option>

                                        <?php }
                                    }else{ 
                                        ?>
                                            <option value="" desabled>Choisir un genre</option>
                                            <option value="Masculin">Masculin</option>
                                            <option value="Feminin">Feminin</option>
                                        <?php  
                                    } 
                                ?>
                  </select>
                </div>
                  <div class="form-group col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                    <label for="exampleInputEmail1">Adresse</label>
                    <input autocomplete="off" required type="text" class="form-control" placeholder="Ex: Boutembo, Q. Kitatumba N° 16"
                                    name="adresse" <?php if (isset($_GET['edit'])) { ?>
                                    value="<?php echo $tab['adresse']; ?> <?php }?>">
                  </div>
                  <div class="form-group col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                    <label for="exampleInputEmail1">Telephone</label>
                    <input autocomplete="off" required type="text" class="form-control" placeholder="Ex: 0000000000"
                                    name="telephone" <?php if (isset($_GET['edit'])) { ?>
                                    value="<?php echo $tab['telephone']; ?> <?php }?>">
                  </div>
                  <div class="form-group col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                    <label for="exampleInputEmail1">password</label>
                    <input autocomplete="off" required type="text" class="form-control" placeholder="Ex: ******"
                                    name="pwd" <?php if (isset($_GET['edit'])) { ?>
                                    value="<?php echo $tab['pwd']; ?> <?php }?>">
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
            <h5 class="text-center">Liste des patients</h5>
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>N°</th>
                  <th>Nom</th>
                  <th>PostNom</th>
                  <th>Prenom</th>
                  <th>Genre</th>
                  <th>Adresse</th>
                  <th>Tel</th>
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
                  <td><?=$recup["nom"];?></td>
                  <td> <?=$recup["postnom"];?></td>
                  <td><?=$recup["prenom"];?></td>
                  <td> <?=$recup["genre"];?></td>
                  <td><?=$recup["adresse"];?></td>
                  <td><?=$recup["telephone"];?></td>
                  <td>
                  <a href='patient.php?edit=<?=$recup['id'] ?>' class="btn btn-info btn-sm "><i
                     class="fas fa-edit"></i></a>
                  <a onclick=" return confirm('Voulez-vous vraiment supprimer ?')"
                  href='../models/delete/del-patient-post.php?idSup=<?=$recup['id'] ?>'
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