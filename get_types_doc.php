<?php
require_once '../Includes/ConnexionBD.php';
$conn = getConnection();
try {
    // Préparer et exécuter la requête
    $stmt = $conn->prepare("SELECT ID_TYPE_DOC, LIBELLE FROM TYPE_DE_DOCUMENT");
    $stmt->execute();

    // Récupérer les résultats
    $types_documents = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur lors de la récupération des types de documents : " . $e->getMessage());
}
?>