<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../Bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <title>Accueil - IPTF Library</title>

    <style>
        /* Style pour le bandeau */
        .hero {
            background: linear-gradient(to bottom, #4A90E2, #1A1F36);
            color: white;
            text-align: center;
            padding: 100px 20px;
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: bold;
        }

        .hero p {
            font-size: 1.2rem;
        }

        /* Style pour les onglets */
        .nav-tabs {
            border-bottom: none;
        }

        .nav-tabs .nav-link {
            font-size: 1.1rem;
            color: #555;
        }

        .nav-tabs .nav-link.active {
            font-weight: bold;
            border-bottom: 3px solid #4A90E2;
        }
    </style>
</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="../img/del.png" alt="Logo" height="40"> IPTF Library
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Parcourir les documents</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Comment ça marche</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">FAQs</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Bandeau -->
    <section class="hero">
        <h1>Découvre. Apprends. Profite</h1>
        <p>Nous faisons votre bonheur</p>
    </section>

    <!-- Parcourir les documents -->
    <div class="container my-5">
        <h2 class="text-center mb-4">Parcourir des documents</h2>
        <ul class="nav nav-tabs justify-content-center" id="myTab">
            <li class="nav-item">
                <button class="nav-link active" id="support-tab" data-bs-toggle="tab" data-bs-target="#support">Support
                    de cours</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="rapport-tab" data-bs-toggle="tab" data-bs-target="#rapport">Rapport de
                    stage</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="td-tab" data-bs-toggle="tab" data-bs-target="#td">Fiche de TD</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="mix-tab" data-bs-toggle="tab" data-bs-target="#mix">Support+Fiche</button>
            </li>
        </ul>

        <div class="tab-content mt-4">
            <div class="tab-pane fade show active" id="support">📚 Liste des supports de cours...</div>
            <div class="tab-pane fade" id="rapport">📄 Liste des rapports de stage...</div>
            <div class="tab-pane fade" id="td">📝 Liste des fiches de TD...</div>
            <div class="tab-pane fade" id="mix">📑 Liste des supports et fiches...</div>
        </div>
    </div>

    <script src="../Bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>