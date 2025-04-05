<?php
session_start(); // Démarrer la session avant d'utiliser $_SESSION
?>

<?php
include '../Includes/header.php';
?>
<div class="container">
    <h2>Connexion</h2>

    <!-- Affichage des messages d'erreur ou de succès -->
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger">
            <?php
            echo $_SESSION['error'];
            unset($_SESSION['error']);
            ?>
        </div>
    <?php endif; ?>

    <form action="../Traitement/connexion_traitement.php" method="POST">
        <div class="mb-3">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control">
        </div>
        <div class="mb-3">
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Se connecter</button>
    </form>
</div>
<?php
include '../Includes/footer.php';
?>