<?php
session_start();
require_once '../Includes/ConnexionBD.php';
$conn = getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titre_doc = $_POST['titre_doc'];
    $id_type_document = $_POST['id_type_document'];
    $id_user = $_POST['id_user'];
    $date_depot = $_POST['date_depot'];
    $specialites = isset($_POST['specialites']) ? $_POST['specialites'] : [];

    // Vérification du fichier
    if (isset($_FILES['fichier']) && $_FILES['fichier']['error'] == 0) {
        $file_name = $_FILES['fichier']['name'];
        $file_tmp = $_FILES['fichier']['tmp_name'];
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);

        if ($file_ext != 'pdf') {
            $_SESSION['error'] = "Seuls les fichiers PDF sont autorisés.";
            header("Location: ../Pages/depot2.php");
            exit();
        }

        // Déplacer le fichier vers le dossier des documents
        $upload_dir = "../uploads/";
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        $file_path = $upload_dir . time() . "_" . $file_name;
        move_uploaded_file($file_tmp, $file_path);

        // Insérer le document dans la table DOCUMENTS
        $stmt = $conn->prepare("INSERT INTO DOCUMENTS (ID_TYPE_DOC, ID_USER, TITRE_DOC, FICHIER_PDF, DATE_DEPOT) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$id_type_document, $id_user, $titre_doc, $file_path, $date_depot]);
        $document_id = $conn->lastInsertId(); // Récupérer l'ID du document inséré

        // Insérer les relations document-spécialité dans DOCUMENT_SPECIALITES
        if (!empty($specialites)) {
            $stmt = $conn->prepare("INSERT INTO DOCUMENT_SPECIALITE (ID_SPECIALITE, ID_DOC) VALUES (?, ?)");
            foreach ($specialites as $id_specialite) {
                $stmt->execute([$id_specialite, $document_id]);
            }
        }

        $_SESSION['success'] = "Document déposé avec succès.";
        header("Location: ../Pages/depot2.php");
        exit();
    } else {
        $_SESSION['error'] = "Erreur lors de l'upload du fichier.";
        header("Location: ../Pages/depot2.php");
        exit();
    }
}
?>