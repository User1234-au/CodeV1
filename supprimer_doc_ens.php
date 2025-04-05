<?php
require_once '../Includes/ConnexionBD.php';
$conn = getConnection();
session_start();

// Vérifier si l’utilisateur est connecté
if (!isset($_SESSION['user'])) {
    $_SESSION['error'] = "Accès refusé.";
    header("Location: ../Pages/connexion.php");
    exit();
}

if (isset($_GET['id'])) {
    $id_doc = intval($_GET['id']);
    $user_id = $_SESSION['user']['id'];

    // Vérifier si le document appartient à l'enseignant
    $stmt = $conn->prepare("SELECT * FROM DOCUMENTS WHERE ID_DOC = ? AND ID_USER = ?");
    $stmt->execute([$id_doc, $user_id]);
    $doc = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($doc) {
        // Suppression du document
        $stmt = $conn->prepare("DELETE FROM DOCUMENTS WHERE ID_DOC = ?");
        if ($stmt->execute([$id_doc])) {
            $_SESSION['success'] = "Document supprimé avec succès.";
        } else {
            $_SESSION['error'] = "Erreur lors de la suppression.";
        }
    } else {
        $_SESSION['error'] = "Vous ne pouvez supprimer que vos propres documents.";
    }
}

header("Location: session_ens.php");
exit();
?>