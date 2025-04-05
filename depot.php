<!--<?php
//session_start();
/*if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: login_form.php");
    exit();
}*/
?>-->

<?php include '../Includes/header.php'; ?>

<div class="container mt-5">
    <h2>Déposer un document</h2>

    <!-- Affichage des messages de succès ou d'erreur -->
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success">
            <?php echo $_SESSION['success'];
            unset($_SESSION['success']); ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger">
            <?php echo $_SESSION['error'];
            unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>

    <!-- Formulaire -->
    <form action="depot_traitement2.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="titre" class="form-label">Titre du document</label>
            <input type="text" class="form-control" id="titre" name="titre">
        </div>
        <div class="mb-3">
            <label for="fichier" class="form-label">Fichier à déposer</label>
            <input type="file" class="form-control" id="fichier" name="fichier">
        </div>
        <div class="mb-3">
            <label for="type_doc" class="form-label">Type de document</label>
            <button type="radio">Support de cours</button>
            <button type="radio">Fiche TD</button>
            <button type="radio">Support de cours+Fiche TD</button>
            <!--<input type="text" class="form-control" id="auteur" name="auteur">-->
        </div>
        <div class="mb-3">
            <!--<label for="description" class="form-label">Description</label>-->
            <input type="hidden" class="form-control" id="user" name="user" value=""></input>
        </div>
        <button type="submit" class="btn btn-primary">Déposer le document</button>
    </form>
</div>

<?php include '../Includes/footer.php'; ?>