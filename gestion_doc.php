<?php //require_once '../Includes/ConnexionBD.php';
session_start(); ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Documents</title>
    <link href="../Boostrap/css/bootstrap.min.css" rel="stylesheet">
    <?php include '../Includes/header.php' ?>
</head>

<body>
    <div class="container mt-5">
        <h1>Gestion des Documents</h1>

        <!-- Barre de recherche -->
        <form method="GET" action="gestion_doc.php" class="d-flex mb-3">
            <input type="text" name="search" class="form-control me-2" placeholder="Rechercher un document..."
                value="<?= isset($search) ? $search : '' ?>">
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </form>
        
        <!-- Affichage des documents -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Type de document</th>
                    <th>Depositaire</th>
                    <th>Date de dépôt</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php require 'get_doc.php' ?>
                <?php if ($documents): ?>
                    <?php foreach ($documents as $doc): ?>
                        <tr>
                            <td><?= htmlspecialchars($doc['TITRE_DOC']) ?></td>
                            <td><?= htmlspecialchars($doc['TYPE_DOCUMENT']) ?></td>
                            <td><?= htmlspecialchars($doc['DEPOSITAIRE']) ?></td>
                            <td><?= htmlspecialchars($doc['DATE_DEPOT']) ?></td>
                            <td>
                                <a href="modifier_doc.php?id=<?= $doc['ID_DOC'] ?>" class="btn btn-warning btn-sm">Modifier</a>
                                <a href="supprimer_doc.php?id=<?= $doc['ID_DOC'] ?>" class="btn btn-danger btn-sm">Supprimer</a>
                                <a href="consulter2_doc.php?id=<?= $doc['ID_DOC'] ?>" class="btn btn-info btn-sm"
                                    target="_blank">Consulter</a>
                                <a href="telecharger_doc.php?id=<?= $doc['ID_DOC'] ?>"
                                    class="btn btn-success btn-sm">Télécharger</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">Aucun document trouvé</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Bouton pour ajouter un nouveau document -->
        <a href="depot2.php" class="btn btn-primary">Déposer un nouveau document</a>
    </div>

    <!-- Ajouter les scripts Bootstrap -->
    <script src="..Boostrap/js/bootstrap.min.js"></script>
    <?php include '../Includes/footer.php' ?>
</body>

</html>