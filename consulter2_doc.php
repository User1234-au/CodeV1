<?php
// Inclure la connexion à la base de données
require_once '../Includes/ConnexionBD.php';
$conn = getConnection();
session_start();

// Vérifier si l'ID du document est passé en paramètre
if (isset($_GET['id'])) {
    $id_doc = $_GET['id'];

    // Préparer la requête pour récupérer le document en fonction de son ID
    $stmt = $conn->prepare("SELECT FICHIER_PDF FROM DOCUMENTS WHERE ID_DOC = ?");
    $stmt->execute([$id_doc]);
    $doc = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérifier si le document existe
    if ($doc) {
        $file_path = '../uploads/' . $doc['FICHIER_PDF']; // Assurez-vous que le chemin du fichier est correct
        if (file_exists($file_path)) {
            // Afficher le PDF dans un lecteur
            echo "<embed src='$file_path' width='100%' height='600px' type='application/pdf'>";
        } else {
            echo "Le document n'existe plus.";
        }
    } else {
        echo "Document non trouvé.";
    }
} else {
    echo "ID de document manquant.";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>$file</title>
</head>

<body>

</body>

</html>