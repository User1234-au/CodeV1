<?php
// Inclure la connexion à la base de données
require_once '../Includes/ConnexionBD.php';
$conn = getConnection();
session_start();

// Vérifier si l'ID de l'utilisateur est passé en paramètre
if (isset($_GET['id'])) {
    $id_user = $_GET['id'];

    // Préparer la requête pour récupérer les détails de l'utilisateur
    $stmt = $conn->prepare("SELECT * FROM UTILISATEURS WHERE ID_USER = ?");
    $stmt->execute([$id_user]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérifier si l'utilisateur existe
    if (!$user) {
        $_SESSION['error'] = "Utilisateur non trouvé.";
        header("Location: gestion_utilisateurs.php");
        exit();
    }

    // Traitement du formulaire de modification
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nom = trim($_POST['nom']);
        $email = trim($_POST['email']);
        $role = trim($_POST['role']);

        // Mettre à jour les données de l'utilisateur
        $updateStmt = $conn->prepare("UPDATE UTILISATEURS SET NOM_USER = ?, EMAIL = ?, ID_ROLE = ? WHERE ID_USER = ?");
        $updateStmt->execute([$nom, $email, $role, $id_user]);

        $_SESSION['success'] = "Utilisateur mis à jour avec succès.";
        header("Location: gestion_utilisateurs.php");
        exit();
    }
} else {
    $_SESSION['error'] = "ID de l'utilisateur manquant.";
    header("Location: gestion_utilisateurs.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'utilisateur</title>
    <link href="../Boostrap/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1>Modifier l'utilisateur</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom"
                    value="<?= htmlspecialchars($user['NOM_USER']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email"
                    value="<?= htmlspecialchars($user['EMAIL']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Rôle</label>
                <select class="form-control" id="role" name="role">
                    <option value="Admin" <?= $user['ID_ROLE'] == 'Admin' ? 'selected' : '' ?>>Admin</option>
                    <option value="User" <?= $user['ID_ROLE'] == 'User' ? 'selected' : '' ?>>Enseignant</option>
                    <option value="Teacher" <?= $user['ID_ROLE'] == 'Teacher' ? 'selected' : '' ?>>Etudiant</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>

    <script src="../Boostrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>