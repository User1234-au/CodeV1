<?php
// Inclure la connexion à la base de données
require_once '../Includes/ConnexionBD.php'; // Vérifie que ce fichier retourne bien $conn
$conn = getConnection();
session_start(); // Démarrer la session

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si la connexion à la BD est bien établie
    if (!isset($conn)) {
        $_SESSION['error'] = "Erreur de connexion à la base de données.";
        header("Location: ../Pages/connexion.php");
        exit();
    }

    // Récupérer les données du formulaire
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Vérifier si les champs sont vides
    if (empty($email) || empty($password)) {
        $_SESSION['error'] = "Veuillez remplir tous les champs.";
        header("Location: ../Pages/connexion.php");
        exit();
    }

    try {
        // Requête pour récupérer l'utilisateur en fonction de l'email
        $stmt = $conn->prepare("SELECT * FROM UTILISATEURS WHERE EMAIL = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérifier si l'utilisateur existe et si le mot de passe est correct
        if ($user && password_verify($password, $user['PWD'])) {
            // Stocker les informations de l'utilisateur dans la session
            $_SESSION['user'] = [
                'id' => $user['ID_USER'],
                'role' => $user['ID_ROLE'],
                'nom' => $user['NOM_USER']
            ];

            // Rediriger en fonction du rôle
            switch ($user['ID_ROLE']) {
                case 1:
                    $_SESSION['success'] = "Connexion réussie ! Bienvenue Administrateur.";
                    header("Location: ../Pages/admin.php");
                    break;
                case 3:
                    $_SESSION['success'] = "Connexion réussie ! Bienvenue Étudiant.";
                    header("Location: ../Pages/session_etu.php");
                    break;
                case 2:
                    $_SESSION['success'] = "Connexion réussie ! Bienvenue Enseignant.";
                    header("Location: ../Pages/session_ens.php");
                    break;
                default:
                    $_SESSION['error'] = "Rôle utilisateur invalide.";
                    header("Location: ../Pages/connexion.php");
                    break;
            }
            exit();
        } else {
            $_SESSION['error'] = "Email ou mot de passe incorrect.";
            header("Location: ../Pages/connexion.php");
            exit();
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = "Erreur interne : " . $e->getMessage();
        header("Location: ../Pages/connexion.php");
        exit();
    }
} else {
    $_SESSION['error'] = "Méthode de requête invalide.";
    header("Location: ../Pages/connexion.php");
    exit();
}
?>