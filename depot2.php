<?php
session_start();
if (!isset($_SESSION['user']) || ($_SESSION['user']['role'] != 1 && $_SESSION['user']['role'] != 2)) {
    header("Location: connexion.php");
    exit();
}

require_once '../Includes/ConnexionBD.php';
$conn = getConnection();

// Récupérer les types de documents
include 'get_types_doc.php';

// Récupérer les spécialités
$stmt = $conn->query("SELECT * FROM SPECIALITE");
$specialites = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dépôt de Document</title>
    <?php include '../Includes/header.php'; ?>
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center">Déposer un Document</h2>

        <!-- Affichage des messages -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success"><?= $_SESSION['success'];
            unset($_SESSION['success']); ?></div>
        <?php endif; ?>
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?= $_SESSION['error'];
            unset($_SESSION['error']); ?></div>
        <?php endif; ?>

        <form action="../Traitement/depot_traitement.php" method="POST" enctype="multipart/form-data"
            class="p-4 border rounded bg-light">
            <input type="hidden" name="id_user" value="<?= $_SESSION['user']['id'] ?>">

            <!-- Titre du document -->
            <div class="mb-3">
                <label for="titre" class="form-label">Titre du document :</label>
                <input type="text" name="titre_doc" id="titre" class="form-control">
            </div>

            <!-- Type de document -->
            <div class="mb-3">
                <label class="form-label">Type de document :</label>
                <?php foreach ($types_documents as $type): ?>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="id_type_document"
                            value="<?= $type['ID_TYPE_DOC'] ?>" <?php if ($_SESSION['user']['role'] == 2 && $type['ID_TYPE_DOC'] == 1)
                                  echo 'disabled'; ?>>
                        <label class="form-check-label"><?= htmlspecialchars($type['LIBELLE']) ?></label>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Sélection des spécialités -->
            <div class="mb-3">
                <label class="form-label">Spécialités concernées :</label>
                <?php foreach ($specialites as $specialite): ?>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="specialites[]"
                            value="<?= $specialite['ID_SPECIALITE'] ?>">
                        <label class="form-check-label"><?= htmlspecialchars($specialite['NOM_SPECIALITE']) ?></label>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Fichier -->
            <div class="mb-3">
                <label for="fichier" class="form-label">Sélectionner un fichier :</label>
                <input type="file" name="fichier" id="fichier" class="form-control" accept="application/pdf">
            </div>

            <input type="hidden" name="date_depot" value="<?= date('Y-m-d H:i:s') ?>">

            <button type="submit" class="btn btn-primary w-100">Déposer</button>
        </form>
    </div>

    <?php include '../Includes/footer.php'; ?>
</body>

</html>