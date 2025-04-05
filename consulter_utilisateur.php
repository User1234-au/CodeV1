<?php
// Inclure la connexion à la base de données
require_once '../Includes/ConnexionBD.php';
$conn = getConnection();
session_start();

// Vérifier si l'ID de l'utilisateur est passé en paramètre
if (isset($_GET['id'])) {
    $id_user = $_GET['id'];

    // Préparer la requête pour récupérer les détails de l'utilisateur
    $stmt = $conn->prepare("SELECT ID_USER, NOM_USER, EMAIL, NOM FROM UTILISATEURS U JOIN ROLES R ON U.ID_ROLE=R.ID_ROLE WHERE ID_USER = ?");
    $stmt->execute([$id_user]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    echo "<h1>CONSULTATION DES INFORMATIONS DE L'UTILISATEUR " . $user['NOM_USER'] . "</h1>";
    // Vérifier si l'utilisateur existe
    if ($user) {
        // Afficher les détails
        echo "<h2>Nom : " . htmlspecialchars($user['NOM_USER']) . "</h2>";
        echo "<h2>Email : " . htmlspecialchars($user['EMAIL']) . "</h2>";
        echo "<h2>Role : " . htmlspecialchars($user['NOM']) . "</h2>";
        // Ajouter d'autres informations que tu souhaites afficher
    } else {
        echo "Utilisateur non trouvé.";
    }
} else {
    echo "ID de l'utilisateur manquant.";
}
?>