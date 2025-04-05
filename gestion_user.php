<?php
// Démarrer la session et inclure la connexion à la base de données
session_start();
require_once '../Includes/ConnexionBD.php';
$conn = getConnection();
// Récupérer les utilisateurs
$stmt = $conn->prepare("SELECT ID_USER, NOM_USER, EMAIL, NOM  FROM UTILISATEURS U JOIN ROLES R ON U.ID_ROLE=R.ID_ROLE");
$stmt->execute();
$utilisateurs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Utilisateurs</title>
    <link href="../Boostrap/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

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


    <div class="container mt-5">
        <h1>Gestion des Utilisateurs</h1>

        <!-- Barre de recherche -->
        <form method="GET" action="gestion_utilisateurs.php" class="d-flex mb-3">
            <input type="text" name="search" class="form-control me-2" placeholder="Rechercher un utilisateur..."
                value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>">
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </form>

        <!-- Affichage des utilisateurs -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($utilisateurs): ?>
                    <?php foreach ($utilisateurs as $user): ?>
                        <tr>
                            <td><?= htmlspecialchars($user['NOM_USER']) ?></td>
                            <td><?= htmlspecialchars($user['EMAIL']) ?></td>
                            <td><?= htmlspecialchars($user['NOM']) ?></td>
                            <td>
                                <a href="consulter_utilisateur.php?id=<?= $user['ID_USER'] ?>"
                                    class="btn btn-info btn-sm">Consulter</a>
                                <a href="modifier_utilisateur.php?id=<?= $user['ID_USER'] ?>"
                                    class="btn btn-warning btn-sm">Modifier</a>
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal"
                                    data-id="<?= $user['ID_USER'] ?>">Supprimer</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">Aucun utilisateur trouvé</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Modal de suppression -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Confirmer la suppression</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Êtes-vous sûr de vouloir supprimer cet utilisateur ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <a id="confirmDelete" class="btn btn-danger">Supprimer</a>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="..Boostrap/js/bootstrap.bundle.min.js"></script>
    <script>
        // Lier l'ID de l'utilisateur à la confirmation de suppression
        const deleteButtons = document.querySelectorAll('[data-bs-target="#deleteModal"]');
        const confirmDeleteButton = document.getElementById('confirmDelete');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const userId = this.getAttribute('data-id');
                confirmDeleteButton.setAttribute('href', `./supprimer_utilisateur.php?id=${userId}`);
            });
        });
    </script>
</body>

</html>