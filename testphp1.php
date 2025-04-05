<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="icon" type="image/png" href="depositphotos_70363523-stock-illustration-login-button-icon.jpg">
    <link rel="stylesheet" href="formulaire.css">
</head>
<body>
    <h1>bienvenue chez NEEA'S services</h1>
    <section class="form1">
        <form action="traitement.php" method="post" class="formu1">
           <!-- <img src="./depositphotos_70363523-stock-illustration-login-button-icon.jpg" alt="depositphotos_70363523-stock-illustration-login-button-icon" id="bg">-->
            <h2>Inscription</h2>
            <label for="username">Nom d'utilisateur</label>
            <input type="text" name="username" id="username" placeholder="username" required>
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" placeholder="password" required>
            <label for="passwordconfirm">Confirmation du mot de passe</label>
            <input type="password" name="passwordconfirm" id="passwordconfirm" placeholder="password confirm" required>
            <button type="reset" id="btn1">S'inscrire</button>
            <p>Déjà inscrit? <a href="formulaire2.html">Se connecter</a></p>
        </form>
    </section>
    <script src="formulaire1.js"></script>
</body>
</html>