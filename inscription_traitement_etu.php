<?php
require_once '../Includes/ConnexionBD.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = trim($_POST['nom_user']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $role = trim($_POST['role']);

    if (empty($nom) || empty($email) || empty($password) || empty($role)) {
        $_SESSION['error'] = "Tous les champs sont obligatoires.";
        header("Location: ../Pages/inscription_Etudiant.php");
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Adresse email invalide.";
        header("Location: ../Pages/inscription_Etudiant.php");
        exit();
    }

    $conn = getConnection();
    $stmt = $conn->prepare("SELECT * FROM UTILISATEURS WHERE EMAIL = ?");
    $stmt->execute([$email]);

    if ($stmt->rowCount() > 0) {
        $_SESSION['error'] = "Cet email est déjà utilisé.";
        header("Location: ../Pages/inscription_Etudiant.php");
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);  // mot de passe haché
    $stmt = $conn->prepare("
        INSERT INTO UTILISATEURS (ID_ROLE, NOM_USER, EMAIL, PWD) 
        VALUES ((SELECT ID_ROLE FROM ROLES WHERE NOM = ?),?, ?, ?)
    ");

    if ($stmt->execute([$role, $nom, $email, $hashed_password])) {
        $_SESSION['success'] = "Inscription réussie. Connectez-vous.";
        header("Location: ../Pages/inscription_Etudiant.php");
        exit();
    } else {
        $_SESSION['error'] = "Une erreur est survenue.";
        header("Location: ../Pages/inscription_Etudiant.php");
        exit();
    }
}
?>