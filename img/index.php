<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Gestion de Rendez-vous d'Hôpital</title>
    <!-- Inclure les styles de Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .hero {
            background: url('path/to/your/hero-image.jpg') no-repeat center center;
            background-size: cover;
            color: white;
            height: 60vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .hero h1 {
            font-size: 3rem;
        }
        .section {
            padding: 2rem 0;
        }
        .card img {
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Hôpital XYZ</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#services">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#about">À propos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-primary ml-2" href="login.html">Se Connecter</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero">
        <div>
            <h1>Bienvenue à l'Hôpital XYZ</h1>
            <p>Gestion facile de vos rendez-vous médicaux</p>
            <a href="appointment.html" class="btn btn-light btn-lg">Prenez un Rendez-vous</a>
        </div>
    </div>

    <!-- Services Section -->
    <div id="services" class="section">
        <div class="container">
            <h2 class="text-center mb-4">Nos Services</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="img/docteur-écrivant-une-prescription-médicale.jpg" class="card-img-top" alt="Service 1">
                        <div class="card-body">
                            <h5 class="card-title">Consultation Générale</h5>
                            <p class="card-text">Obtenez des conseils médicaux complets et des diagnostics précis.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="img/groupe-de-médecins-infirmières-ambulanciers-paramédicaux-poussent-gurney-civière-avec.jpg" class="card-img-top" alt="Service 2">
                        <div class="card-body">
                            <h5 class="card-title">Urgences</h5>
                            <p class="card-text">Soins urgents disponibles 24/7 pour les situations critiques.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="img/vue-laterale-homme-portant-blouse-laboratoire_23-2149633831.jpg" class="card-img-top" alt="Service 3">
                        <div class="card-body">
                            <h5 class="card-title">Spécialistes</h5>
                            <p class="card-text">Consultez nos médecins spécialisés pour des soins ciblés.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- About Section -->
    <div id="about" class="section bg-light">
        <div class="container">
            <h2 class="text-center mb-4">À Propos de Nous</h2>
            <p class="text-center">Nous sommes dédiés à fournir des soins de santé de haute qualité. Notre équipe de médecins et de personnel médical est là pour vous aider à chaque étape de votre parcours de santé.</p>
        </div>
    </div>

    <!-- Contact Section -->
    <div id="contact" class="section">
        <div class="container">
            <h2 class="text-center mb-4">Contactez-Nous</h2>
            <div class="row">
                <div class="col-md-6 mb-4">
                    <h4>Adresse</h4>
                    <p>123 Rue de l'Hôpital, Ville, Pays</p>
                </div>
                <div class="col-md-6 mb-4">
                    <h4>Téléphone</h4>
                    <p>(123) 456-7890</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3">
        <p>&copy; 2024 Hôpital XYZ. Tous droits réservés.</p>
    </footer>

    <!-- Inclure les scripts de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
