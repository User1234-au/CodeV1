<?php
require_once '../Includes/ConnexionBD.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Validation des champs
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $_SESSION['error'] = "Tous les champs sont obligatoires.";
        header("Location: inscription.php");
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Adresse email invalide.";
        header("Location: inscription.php");
        exit();
    }

    if ($password !== $confirm_password) {
        $_SESSION['error'] = "Les mots de passe ne correspondent pas.";
        header("Location: inscription.php");
        exit();
    }

    // Connexion à la base de données
    $conn = getConnection();

    // Vérifier si l'email existe déjà
    $stmt = $conn->prepare("SELECT * FROM utilisateurs WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->rowCount() > 0) {
        $_SESSION['error'] = "Cette adresse email est déjà utilisée.";
        header("Location: inscription.php");
        exit();
    }

    // Hashage du mot de passe
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Insertion dans la base de données avec le rôle par défaut "user"
    $stmt = $conn->prepare("INSERT INTO utilisateurs (nom_user, email, password, role) VALUES (?, ?, ?, 'user')");
    if ($stmt->execute([$username, $email, $hashed_password])) {
        $_SESSION['success'] = "Inscription réussie. Vous pouvez maintenant vous connecter.";
        header("Location: login_form.php");
    } else {
        $_SESSION['error'] = "Une erreur est survenue lors de l'inscription.";
        header("Location: inscription.php");
    }

    exit();
} else {
    $_SESSION['error'] = "Méthode de requête invalide.";
    header("Location: inscription.php");
    exit();
}
?>