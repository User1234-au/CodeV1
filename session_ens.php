<?php
require_once '../Includes/ConnexionBD.php';
$conn = getConnection();
session_start();

// Vérifier si l'utilisateur est connecté et est un enseignant
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 2) {
    $_SESSION['error'] = "Accès refusé.";
    header("Location: ../Pages/connexion.php");
    exit();
}

// Récupérer les documents sauf les rapports de stage (id_type_doc != X, à remplacer par l’ID réel des rapports)
/*$stmt = $conn->prepare("SELECT * FROM DOCUMENTS WHERE ID_TYPE_DOC != ?");
$idRapportStage = 1; // Remplace 1 par l'ID réel des rapports de stage
$stmt->execute([$idRapportStage]);
$documents = $stmt->fetchAll(PDO::FETCH_ASSOC);*/
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Enseignant</title>
    <link rel="stylesheet" href="../Boostrap/css/bootstrap.min.css">

</head>

<body>

    <div class="container mt-5">
        <h1>Bienvenue, <?= htmlspecialchars($_SESSION['user']['nom']); ?> 👨‍🏫</h1>


        <p>Voici la liste des documents disponibles :</p>

        <!--<?php //include 'get_doc.php'; ?>-->

        <!-- Tableau des documents -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Type</th>
                    <th>Depositaire</th>
                    <th>Date de dépôt</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php include 'get_doc.php' ?>
                <?php if ($documents): ?>
                    <?php foreach ($documents as $doc): ?>
                        <tr>
                            <td><?= htmlspecialchars($doc['TITRE_DOC']) ?></td>
                            <td><?= htmlspecialchars($doc['TYPE_DOCUMENT']) ?></td> <!-- A remplacer par le libellé -->
                            <td><?= htmlspecialchars($doc['DEPOSITAIRE']) ?></td> <!-- A remplacer par le nom de l’auteur -->
                            <td><?= htmlspecialchars($doc['DATE_DEPOT']) ?></td>
                            <td>
                                <a href="consulter2_doc.php?id=<?= $doc['ID_DOC'] ?>" class="btn btn-info btn-sm">Consulter</a>
                                <a href="telecharger_doc.php?id=<?= $doc['ID_DOC'] ?>"
                                    class="btn btn-success btn-sm">Télécharger</a>
                                <?php if ($doc['ID_USER'] == $_SESSION['user']['id']): ?>
                                    <a href="modifier_doc.php?id=<?= $doc['ID_DOC'] ?>" class="btn btn-warning btn-sm">Modifier</a>
                                    <button class="btn btn-danger btn-sm btn-supprimer" data-bs-toggle="modal"
                                        data-bs-target="#confirmDeleteModal" data-id="<?= $doc['ID_DOC'] ?>">Supprimer</button>
                                <?php endif; ?>
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

        <a href="depot2.php" class="btn btn-primary mb-3">📥 Déposer un document</a>

        <!-- Modal de confirmation pour suppression -->
        <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmation de suppression</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Êtes-vous sûr de vouloir supprimer ce document ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <a id="confirmDeleteButton" href="#" class="btn btn-danger">Confirmer</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts Bootstrap et gestion du modal -->
    <script src="../Boostrap/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const confirmDeleteButton = document.getElementById("confirmDeleteButton");
            document.querySelectorAll(".btn-supprimer").forEach(button => {
                button.addEventListener("click", function () {
                    const docId = this.getAttribute("data-id");
                    confirmDeleteButton.setAttribute("href", "supprimer_doc_ens.php?id=" + docId);
                });
            });
        });
    </script>
</body>

</html>