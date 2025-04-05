<?php
// Inclure la connexion à la base de données
require_once '../Includes/ConnexionBD.php'; // Assure-toi que ce fichier retourne l'objet de connexion $conn

// Vérifier si la connexion à la base de données a réussi
if (!isset($conn)) {
    die("Erreur de connexion à la base de données.");
}

// Récupérer la valeur de recherche s'il y en a
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

// Préparer la requête SQL pour récupérer les documents
$query = "SELECT d.ID_DOC, d.TITRE_DOC, t.LIBELLE AS TYPE_DOC, u.NOM_USER AS AUTEUR, d.DATE_DEPOT
          FROM DOCUMENTS d
          JOIN TYPE_DE_DOCUMENT t ON d.ID_TYPE_DOC = t.ID_TYPE_DOC
          JOIN UTILISATEURS u ON d.ID_USER = u.ID_USER";

if (!empty($search)) {
    $query .= " WHERE d.TITRE_DOC LIKE :search OR u.NOM_USER LIKE :search";  // Si recherche
}

// Préparer la requête
$stmt = $conn->prepare($query);

// Si une recherche est effectuée, lier le paramètre
if (!empty($search)) {
    $searchParam = "%$search%";
    $stmt->bindParam(':search', $searchParam, PDO::PARAM_STR);
}

// Exécuter la requête
$stmt->execute();

// Récupérer les résultats
$documents = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>