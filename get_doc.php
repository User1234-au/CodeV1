<?php
require_once '../Includes/ConnexionBD.php';
$conn = getConnection();

// Vérifier si une recherche a été effectuée
$search = isset($_GET['search']) ? trim($_GET['search']) : "";

// Requête SQL pour récupérer les documents
$sql = "SELECT d.ID_DOC, d.TITRE_DOC,
               t.LIBELLE AS TYPE_DOCUMENT, 
               CONCAT(u.NOM_USER) AS DEPOSITAIRE, d.DATE_DEPOT,u.ID_USER
        FROM DOCUMENTS d
        JOIN TYPE_DE_DOCUMENT t ON d.ID_TYPE_DOC = t.ID_TYPE_DOC
        JOIN UTILISATEURS u ON d.ID_USER = u.ID_USER";

if (!empty($search)) {
    $sql .= " WHERE d.TITRE_DOC LIKE :search OR u.NOM_USER LIKE :search OR t.LIBELLE LIKE :search";
}

$stmt = $conn->prepare($sql);

if (!empty($search)) {
    $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
}
try {
    $stmt->execute();
    $documents = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur SQL : " . $e->getMessage();
}

