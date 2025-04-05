<?php
require_once '../Includes/ConnexionBD.php';
$conn = getConnection();
session_start();

if (!isset($_GET['id']) || empty($_GET['id'])) {
    $_SESSION['error'] = "ID du document invalide.";
    header("Location: gestion_doc.php");
    exit();
}

$id_doc = $_GET['id'];

// Récupérer les informations du document
$stmt = $conn->prepare("SELECT d.TITRE_DOC, d.FICHIER_PDF, d.DATE_DEPOT, 
                                t.LIBELLE AS TYPE, 
                                CONCAT(u.NOM_USER) AS AUTEUR
                        FROM DOCUMENTS d
                        JOIN TYPE_DE_DOCUMENT t ON d.ID_TYPE_DOC = t.ID_TYPE_DOC
                        JOIN UTILISATEURS u ON d.ID_USER = u.ID_USER
                        WHERE d.ID_DOC = ?");
$stmt->execute([$id_doc]);
$document = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$document) {
    $_SESSION['error'] = "Document introuvable.";
    header("Location: gestion_doc.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Consulter un document</title>
    <link href="../Boostrap/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Informations du document</h2>
        <p><strong>Titre :</strong> <?= htmlspecialchars($document['TITRE_DOC']) ?></p>
        <p><strong>Type :</strong> <?= htmlspecialchars($document['TYPE']) ?></p>
        <p><strong>Auteur :</strong> <?= htmlspecialchars($document['AUTEUR']) ?></p>
        <p><strong>Date de dépôt :</strong> <?= htmlspecialchars($document['DATE_DEPOT']) ?></p>
        <p><a href="gestion_doc.php" class="btn btn-secondary">Retour</a></p>
    </div>
</body>

</html>