<?php

// Inclure le fichier de connexion
include '../connexion/connexion.php';

?>
 
 <!-- Navbar -->
 <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../../index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class=""><h3>profile</h3></i>
          <span class="badge badge-danger navbar-badge"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="../assets/dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                <?php echo $_SESSION["noms"];?>
                  <span class="float-right text-sm text-danger"><i class=""></i></span>
                </h3>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="../models/log-out.php" class="dropdown-item dropdown-footer">Se déconnecter</a>
        </div>
      </li>
     
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../assets/index3.html" class="brand-link">
      <img src=""
           alt=""
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light"></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        
          <?php if(isset($_SESSION['admin'])) { ?>
          <li class="nav-item">
            <a href="patient.php" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>
                Patients
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="medecin.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Medecins
              </p>
            </a>
          </li>
          <li class="nav-item ">
            <a href="rendez-vous.php" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Rendez-vous
              </p>
            </a>
          </li>
          <li class="nav-item ">
            <a href="information.php" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
              Informations
              </p>
            </a>
          </li> 
          <?php } ?>
          <?php if(isset($_SESSION['medecin'])) { ?>
          <li class="nav-item ">
            <a href="prescription.php" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
              Prescription
              </p>
            </a>
          </li>
          <li class="nav-item ">
            <a href="consultation.php" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Consultation
              </p>
            </a>
          </li>
          
          <li class="nav-item ">
            <a href="afficher_resultat.php" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Résultat
              </p>
            </a>
          </li>
          <li class="nav-item ">
            <a href="valider.php" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Valider rendez-vous
              </p>
            </a>
          </li>
          <?php } ?>

          <?php if(isset($_SESSION['patient'])) { ?>
            <li class="nav-item ">
            <a href="afficher_resultat.php" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Résultat
              </p>
            </a>
          </li>
          <?php } ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>