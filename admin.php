<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Inclure Bootstrap -->
    <link href="../Boostrap/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="admin">
    <!-- Barre de navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Admin Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Déconnexion</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenu principal -->

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success">
            <?php echo $_SESSION['success'];
            unset($_SESSION['success']); ?>
        </div>
    <?php endif; ?>

    <div class="container my-5">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1 class="mb-4">Bienvenue, Admin</h1>
                <p>Que souhaitez-vous gérer aujourd'hui ?</p>
            </div>
        </div>
        <div class="row">
            <!-- Gestion des utilisateurs -->
            <div class="col-md-6 mb-4">
                <div class="card border-primary">
                    <div class="card-body text-center">
                        <h5 class="card-title">Gérer les utilisateurs</h5>
                        <p class="card-text">Ajoutez, modifiez ou supprimez des utilisateurs.</p>
                        <a href="gestion_user.php" class="btn btn-primary">Accéder</a>
                    </div>
                </div>
            </div>
            <!-- Gestion des documents -->
            <div class="col-md-6 mb-4">
                <div class="card border-success">
                    <div class="card-body text-center">
                        <h5 class="card-title">Gérer les documents</h5>
                        <p class="card-text">Ajoutez, modifiez ou supprimez des documents.</p>
                        <a href="gestion_doc.php" class="btn btn-success">Accéder</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="mt-4 py-4 bg-light text-center">
        <p>© 2025 Bibliothèque Numérique. Tous droits réservés.</p>
    </footer>


    <!-- Inclure Bootstrap JS -->
    <script src="../Boostrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>