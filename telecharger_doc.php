<?php
require_once '../Includes/ConnexionBD.php';
$conn = getConnection();

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID du document invalide.");
}

$id_doc = $_GET['id'];

$stmt = $conn->prepare("SELECT FICHIER_PDF FROM DOCUMENTS WHERE ID_DOC = ?");
$stmt->execute([$id_doc]);
$document = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$document) {
    die("Document introuvable.");
}

$file = "../uploads/" . $document['FICHIER_PDF'];

if (file_exists($file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="' . basename($file) . '"');
    readfile($file);
    exit();
} else {
    die("Fichier introuvable.");
}
?>
