<?php
require_once '../Includes/ConnexionBD.php';
$conn = getConnection();
session_start();

// Vérifier si l'utilisateur est connecté et est un étudiant
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 3) {
    $_SESSION['error'] = "Accès refusé.";
    header("Location: ../Pages/connexion.php");
    exit();
}

// Récupérer les documents triés par type
$query = "
    SELECT d.ID_DOC, d.TITRE_DOC, d.ID_TYPE_DOC, t.LIBELLE AS TYPE_DOC
    FROM DOCUMENTS d
    JOIN TYPE_DE_DOCUMENT t ON d.ID_TYPE_DOC = t.ID_TYPE_DOC
    ORDER BY t.LIBELLE, d.TITRE_DOC
";
$stmt = $conn->prepare($query);
$stmt->execute();
$documents = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Organiser les documents par type
$documentsParType = [];
foreach ($documents as $doc) {
    $documentsParType[$doc['TYPE_DOC']][] = $doc;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Étudiant</title>
    <link rel="stylesheet" href="../Boostrap/css/bootstrap.min.css">
    <?php include '../Includes/header.php' ?>

    <style>
        .document-card {
            position: relative;
            width: 300px;
            height: 300px;
            margin: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            background-color: #f9f9f9;
            transition: transform 0.3s ease;
            cursor: pointer;
        }

        .document-card:hover {
            transform: scale(1.05);
        }

        .document-card img {
            width: 100%;
            height: 70%;
            object-fit: cover;
        }

        .document-card .title {
            font-size: 16px;
            font-weight: bold;
            margin: 10px;
        }

        .document-card .actions {
            position: absolute;
            bottom: 10px;
            left: 10px;
            right: 10px;
            display: flex;
            justify-content: space-between;
        }

        .document-card .actions a {
            font-size: 14px;
            color: white;
        }

        .document-card .actions a:disabled {
            background-color: grey;
            cursor: not-allowed;
        }

        .section-title {
            margin-top: 30px;
            font-size: 20px;
            font-weight: bold;
            color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1>Bienvenue, <?= htmlspecialchars($_SESSION['user']['nom']); ?> 🎓</h1>
        <p>Recherchez un document par son titre :</p>

        <!-- Barre de recherche -->
        <form method="GET" action="session_etu.php" class="d-flex mb-3">
            <input type="text" name="search" class="form-control me-2" placeholder="Rechercher un document..."
                value="<?= isset($search) ? $search : '' ?>">
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </form>

        <?php require 'get_doc.php' ?>
        <?php if ($documentsParType): ?>
            <?php foreach ($documentsParType as $type => $docs): ?>
                <div class="section-title"><?= htmlspecialchars($type) ?></div>
                <div class="row">
                    <?php foreach ($docs as $doc): ?>
                        <div class="col-md-4">
                            <div class="document-card" onclick="activerBoutons('<?= $doc['ID_DOC'] ?>')">
                                <img src="../img/books.jpg" alt="Document">
                                <div class="title"><?= htmlspecialchars($doc['TITRE_DOC']) ?></div>
                                <div class="actions">
                                    <a href="consulter2_doc.php?id=<?= $doc['ID_DOC'] ?>" class="btn btn-info btn-sm disabled"
                                        id="consulter-<?= $doc['ID_DOC'] ?>">Consulter</a>
                                    <a href="telecharger_doc.php?id=<?= $doc['ID_DOC'] ?>" class="btn btn-success btn-sm disabled"
                                        id="telecharger-<?= $doc['ID_DOC'] ?>">Télécharger</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucun document trouvé.</p>
        <?php endif; ?>
    </div>

    <?php include '../Includes/footer.php' ?>
    <script src="../Boostrap/js/bootstrap.bundle.min.js"></script>

    <script>
        function activerBoutons(docId) {
            document.getElementById('consulter-' + docId).classList.remove('disabled');
            document.getElementById('telecharger-' + docId).classList.remove('disabled');
        }

        function filtrerDocuments() {
            let input = document.getElementById("searchBar").value.toLowerCase();
            let cards = document.getElementsByClassName("document-card");

            for (let card of cards) {
                let title = card.querySelector(".title").innerText.toLowerCase();
                if (title.includes(input)) {
                    card.parentElement.style.display = "block";
                } else {
                    card.parentElement.style.display = "none";
                }
            }
        }
    </script>
</body>

</html>