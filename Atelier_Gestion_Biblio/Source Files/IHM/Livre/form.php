<?php
require_once "DAO.php";
require_once "Document.php";
require_once "Livre.php";
require_once "Dictionnaire.php";
require_once "Biblio.php";

$biblio = new Biblio();

$edit = false;
$doc = null;

// 🔵 Mode modification
if(isset($_GET['edit'])){
    $edit = true;
    $code = $_GET['code'];
    $type = $_GET['type'];
    $doc = $biblio->rechercher($code, $type);
}

// 🔴 Envoi formulaire
if(isset($_POST['submit'])){
    $type = $_POST['type'];

    if($type == "livre"){
        $document = new Livre(
            $_POST['code'],
            $_POST['titre'],
            $_POST['auteur'],
            $_POST['nbrepages']
        );
    } else {
        $document = new Dictionnaire(
            $_POST['code'],
            $_POST['titre'],
            $_POST['langue'],
            $_POST['nbremots']
        );
    }

    if(isset($_POST['edit'])){
        $biblio->modifier($document);
    } else {
        $biblio->ajouter($document);
    }

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Formulaire</title>
</head>
<body>

<h2><?= $edit ? "Modifier" : "Ajouter" ?> un document</h2>

<form method="POST">

    <input type="hidden" name="edit" value="<?= $edit ?>">

    <label>Type :</label>
    <select name="type" onchange="this.form.submit()">
        <option value="livre">Livre</option>
        <option value="dictionnaire">Dictionnaire</option>
    </select>

    <br><br>

    <input type="text" name="code" placeholder="Code"
        value="<?= $doc['code'] ?? '' ?>" required><br><br>

    <input type="text" name="titre" placeholder="Titre"
        value="<?= $doc['titre'] ?? '' ?>" required><br><br>

    <div id="livre">
        <input type="text" name="auteur" placeholder="Auteur"
            value="<?= $doc['auteur'] ?? '' ?>"><br><br>

        <input type="number" name="nbrepages" placeholder="Nombre de pages"
            value="<?= $doc['nbrepages'] ?? '' ?>"><br><br>
    </div>

    <div id="dictionnaire">
        <input type="text" name="langue" placeholder="Langue"
            value="<?= $doc['langue'] ?? '' ?>"><br><br>

        <input type="number" name="nbremots" placeholder="Nombre de mots"
            value="<?= $doc['nbremots'] ?? '' ?>"><br><br>
    </div>

    <button type="submit" name="submit">
        <?= $edit ? "Modifier" : "Ajouter" ?>
    </button>

</form>

<br>
<a href="index.php">⬅ Retour</a>

</body>
</html>