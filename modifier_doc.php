<?php
require_once '../Includes/ConnexionBD.php';
$conn = getConnection();
session_start();

// Vérifier si l'ID du document est passé en paramètre
if (!isset($_GET['id']) || empty($_GET['id'])) {
    $_SESSION['error'] = "ID du document invalide.";
    header("Location: gestion_doc.php");
    exit();
}

$id_doc = $_GET['id'];

// Récupérer les informations du document
$stmt = $conn->prepare("SELECT * FROM DOCUMENTS WHERE ID_DOC = ?");
$stmt->execute([$id_doc]);
$document = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$document) {
    $_SESSION['error'] = "Document introuvable.";
    header("Location: gestion_doc.php");
    exit();
}

// Traitement du formulaire de modification
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titre = trim($_POST['titre_doc']);
    $id_type_doc = $_POST['id_type_doc'];

    $update = $conn->prepare("UPDATE DOCUMENTS SET TITRE_DOC = ?, ID_TYPE_DOC = ? WHERE ID_DOC = ?");
    $update->execute([$titre, $id_type_doc, $id_doc]);

    $_SESSION['success'] = "Document mis à jour avec succès.";
    header("Location: gestion_doc.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Modifier un document</title>
    <link href="../Boostrap/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Modifier le document</h2>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Titre du document</label>
                <input type="text" name="titre_doc" class="form-control"
                    value="<?= htmlspecialchars($document['TITRE_DOC']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Type de document</label>
                <select name="id_type_doc" class="form-select">
                    <?php
                    $types = $conn->query("SELECT * FROM TYPE_DE_DOCUMENT")->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($types as $type) {
                        $selected = ($document['ID_TYPE_DOC'] == $type['ID_TYPE_DOC']) ? "selected" : "";
                        echo "<option value='{$type['ID_TYPE_DOC']}' $selected>{$type['LIBELLE']}</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Modifier</button>
            <a href="gestion_doc.php" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</body>

</html>