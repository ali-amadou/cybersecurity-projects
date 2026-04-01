<?php
require_once "DAO.php";
require_once "Document.php";
require_once "Livre.php";
require_once "Dictionnaire.php";
require_once "Biblio.php";

$biblio = new Biblio();

// 🔴 Suppression
if(isset($_GET['delete'])){
    $code = $_GET['code'];
    $type = $_GET['type'];
    $biblio->supprimer($code, $type);
}

// 🔵 Recherche
if(isset($_GET['search']) && $_GET['search'] != ""){
    $documents = [];
    $documents[] = $biblio->rechercher($_GET['search'], $_GET['type']);
} else {
    // 🔵 Filtrage
    $type = isset($_GET['type']) ? $_GET['type'] : 'all';
    $documents = $biblio->lister($type);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Bibliothèque</title>
</head>
<body>

<h2>📚 Gestion de Bibliothèque</h2>

<a href="form.php">➕ Ajouter un document</a>

<br><br>

<!-- 🔎 Recherche -->
<form method="GET">
    <input type="text" name="search" placeholder="Rechercher par code">
    
    <select name="type">
        <option value="livre">Livre</option>
        <option value="dictionnaire">Dictionnaire</option>
    </select>

    <button type="submit">Rechercher</button>
</form>

<br>

<!-- 🔍 Filtrage -->
<form method="GET">
    <select name="type">
        <option value="all">Tous</option>
        <option value="livre">Livres</option>
        <option value="dictionnaire">Dictionnaires</option>
    </select>
    <button type="submit">Filtrer</button>
</form>

<br>

<!-- 🔢 Nombre de documents -->
<p>
<b>Total livres :</b> <?= $biblio->nbre_documents('livre') ?><br>
<b>Total dictionnaires :</b> <?= $biblio->nbre_documents('dictionnaire') ?><br>
<b>Total général :</b> <?= $biblio->nbre_documents('all') ?>
</p>

<br>

<table border="1" cellpadding="10">
    <tr>
        <th>Code</th>
        <th>Titre</th>
        <th>Infos</th>
        <th>Actions</th>
    </tr>

    <?php foreach($documents as $doc){ 
        if(!$doc) continue; // éviter erreur si null
    ?>
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

            |

            <a onclick="return confirm('Supprimer ce document ?')"
               href="?delete=1&code=<?= $doc['code'] ?>&type=<?= isset($doc['auteur']) ? 'livre' : 'dictionnaire' ?>">
               ❌ Supprimer
            </a>
        </td>
    </tr>
    <?php } ?>

</table>

</body>
</html>