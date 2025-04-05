<?php
require_once '../Includes/ConnexionBD.php';
session_start();

$conn = getConnection();

// Vérifier si l'ID est bien passé
if (!isset($_GET['id'])) {
    $_SESSION['error'] = "Aucun document sélectionné.";
    header("Location: gestion_doc.php");
    exit();
}

$id_doc = $_GET['id'];

// Récupérer le fichier du document pour le supprimer du serveur
$stmt = $conn->prepare("SELECT FICHIER_PDF FROM DOCUMENTS WHERE ID_DOC = ?");
$stmt->execute([$id_doc]);
$doc = $stmt->fetch(PDO::FETCH_ASSOC);

if ($doc) {
    // Supprimer le fichier du serveur
    $file_path = "../uploads/" . $doc['FICHIER_PDF'];
    if (file_exists($file_path)) {
        unlink($file_path);
    }

    // Supprimer le document de la base
    $stmt = $conn->prepare("DELETE FROM DOCUMENTS WHERE ID_DOC = ?");
    if ($stmt->execute([$id_doc])) {
        $_SESSION['success'] = "Document supprimé avec succès.";
    } else {
        $_SESSION['error'] = "Erreur lors de la suppression du document.";
    }
} else {
    $_SESSION['error'] = "Document introuvable.";
}

header("Location: gestion_doc.php");
exit();
?>