<?php
// Inclure la connexion à la base de données
require_once '../Includes/ConnexionBD.php';
session_start();

// Vérifier si l'ID de l'utilisateur est passé en paramètre
if (isset($_GET['id'])) {
    $id_user = $_GET['id'];

    // Préparer la requête pour supprimer l'utilisateur
    $stmt = $conn->prepare("DELETE FROM UTILISATEURS WHERE ID_USER = ?");
    $stmt->execute([$id_user]);

    // Vérifier si l'utilisateur a été supprimé
    if ($stmt->rowCount() > 0) {
        $_SESSION['success'] = "Utilisateur supprimé avec succès.";
    } else {
        $_SESSION['error'] = "Erreur lors de la suppression de l'utilisateur.";
    }

    // Rediriger vers la gestion des utilisateurs
    header("Location: gestion_utilisateurs.php");
    exit();
} else {
    $_SESSION['error'] = "ID de l'utilisateur manquant.";
    header("Location: gestion_users.php");
    exit();
}
?>