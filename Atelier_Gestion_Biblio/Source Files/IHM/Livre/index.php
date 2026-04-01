<?php
require_once "DAO.php";
require_once "Document.php";
require_once "Livre.php";
require_once "Dictionnaire.php";
require_once "Biblio.php";

$biblio = new Biblio();

//  Suppression
if(isset($_GET['delete'])){
    $code = $_GET['code'];
    $type = $_GET['type'];
    $biblio->supprimer($code, $type);
}

//  Liste des documents
$type = isset($_GET['type']) ? $_GET['type'] : 'all';
$documents = $biblio->lister($type);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Bibliothèque</title>
</head>
<body>

<h2>Gestion de Bibliothèque</h2>

<a href="form.php">➕ Ajouter un document</a>

<br><br>

<form method="GET">
    <select name="type">
        <option value="all">Tous</option>
        <option value="livre">Livres</option>
        <option value="dictionnaire">Dictionnaires</option>
    </select>
    <button type="submit">Filtrer</button>
</form>

<br>

<table border="1" cellpadding="10">
    <tr>
        <th>Code</th>
        <th>Titre</th>
        <th>Infos</th>
        <th>Actions</th>
    </tr>

    <?php foreach($documents as $doc){ ?>
    <tr>
        <td><?= $doc['code'] ?></td>
        <td><?= $doc['titre'] ?></td>
        <td>
            <?php 
            if(isset($doc['auteur'])){
                echo "Auteur: ".$doc['auteur']." | Pages: ".$doc['nbrepages'];
            } else {
                echo "Langue: ".$doc['langue']." | Mots: ".$doc['nbremots'];
            }
            ?>
        </td>
        <td>
            <a href="form.php?edit=1&code=<?= $doc['code'] ?>&type=<?= isset($doc['auteur']) ? 'livre' : 'dictionnaire' ?>">
                ✏️ Modifier
            </a>

            <a href="?delete=1&code=<?= $doc['code'] ?>&type=<?= isset($doc['auteur']) ? 'livre' : 'dictionnaire' ?>">
                
            </a>
        </td>
    </tr>
    <?php } ?>

</table>

</body>
</html>