<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IPTF Library - Accueil</title>
    <link href="../Boostrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Styles personnalisés */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif
        }

        .hero {
            background: linear-gradient(to bottom, #2c698d, #1b3b58);
            color: white;
            padding: 100px 20px;
            text-align: center;
        }

        .section-title {
            text-align: center;
            margin-bottom: 40px;
            font-weight: bold;
        }

        .steps {
            display: flex;
            justify-content: center;
            gap: 40px;
            flex-wrap: wrap;
        }

        .step {
            text-align: center;
            width: 250px;
        }

        .step i {
            font-size: 40px;
            color: #2c698d;
        }

        #about {
            background-color: #f8f9fa;
            padding: 60px 20px;
        }

        #how-it-works {
            background-color: #e9ecef;
            padding: 60px 20px;
        }

        #features {
            background: url('../img/library.jpg') no-repeat center center/cover;
            color: white;
            padding: 80px 20px;
            text-align: center;
        }

        .resources {
            background-color: #f1f1f1;
            padding: 60px 20px;
            text-align: center;
        }

        .resource-gallery {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .resource-item {
            width: 150px;
            text-align: center;
        }

        .resource-item img {
            width: 100%;
            border-radius: 8px;
        }

        .footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 20px 0;
        }
    </style>
</head>

<body>

    <!-- Barre de navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">📚 IPTF Library</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="accueil.php">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="connexion.php">Connexion</a></li>
                    <li class="nav-item"><a class="nav-link" href="inscription.php">Inscription</a></li>
                    <li class="nav-item"><a class="nav-link" href="#how-it-works">Comment ça marche</a></li>
                    <li class="nav-item"><a class="nav-link" href="#ressources">Ressources disponibles</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">À propos</a></li>

                </ul>
            </div>
        </div>
    </nav>

    <!-- Section Hero -->
    <div class="hero">
        <h1>Découvre. Apprends. Profite.</h1>
        <p>Nous faisons votre bonheur en vous offrant un accès facile aux documents académiques.</p>
    </div>


    <!-- Section Ressources disponibles -->
    <section id="ressources" class="resources">
        <h2 class="section-title">Ressources disponibles</h2>
        <p>Accédez à une large gamme de documents académiques.</p>
        <div class="resource-gallery">
            <div class="resource-item">
                <img src="../img/books.jpg" alt="Livre 1">
                <p>Support de cours</p>
            </div>
            <div class="resource-item">
                <img src="../img/book2.jpg" alt="Livre 2">
                <p>Fiches de TD</p>
            </div>
            <div class="resource-item">
                <img src="../img/books.jpg" alt="Livre 3">
                <p>Rapports de stage</p>
            </div>
            <div class="resource-item">
                <img src="../img/book2.jpg" alt="Livre 3">
                <p>Support+Fiche TD</p>
            </div>
        </div>
    </section>


    <!-- Section Comment ça marche -->
    <section id="how-it-works" class="container py-5">
        <h2 class="section-title">Comment ça marche ?</h2>
        <div class="steps">
            <div class="step">
                <i class="bi bi-person-plus"></i>
                <h5>1. Inscription</h5>
                <p>Créez un compte pour accéder aux documents.</p>
            </div>
            <div class="step">
                <i class="bi bi-search"></i>
                <h5>2. Recherche</h5>
                <p>Parcourez et trouvez les documents dont vous avez besoin.</p>
            </div>
            <div class="step">
                <i class="bi bi-cloud-arrow-down"></i>
                <h5>3. Téléchargement</h5>
                <p>Accédez aux documents en un clic.</p>
            </div>
            <div class="step">
                <i class="bi bi-upload"></i>
                <h5>4. Partage</h5>
                <p>Déposez des documents pour aider la communauté.</p>
            </div>
        </div>
    </section>

    <!-- Section À propos -->
    <section id="about" class="container py-5">
        <h2 class="section-title">À propos</h2>
        <p class="text-center">
            IPTF Library est une plateforme conçue pour faciliter l'accès aux documents académiques des étudiants et
            enseignants.
            Elle permet de parcourir, télécharger et déposer des documents en toute simplicité.
            Grâce à notre interface intuitive et à notre large sélection de ressources, nous aidons les apprenants à
            réussir leurs études en ayant toujours accès aux informations dont ils ont besoin.
        </p>
    </section>

    <!-- Pied de page -->
    <footer class="footer">
        <p>&copy; 2025 IPTF Library. Tous droits réservés.</p>
    </footer>

    <script src="../Boostrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>