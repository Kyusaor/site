<?php
include '../../src/controler/session.php';
$translations = $_SESSION['translations']->getInstance();
$translatPath = "pages.about.";
?>
<!DOCTYPE html>
<html lang="<?= $_SESSION['language'] ?>">
<head>
    <?php include '../../vue/partials/head.html'; ?>
    <title><?= getTitle() ?></title>
</head>

<body>
<?php
include '../../vue/partials/header.php';
include '../../vue/partials/navmenu.php';
?>

<main>
    <h2><?= $translations->get($translatPath . 'mainTitle') ?></h2>

    <p><?= $translations->get($translatPath . 'botBody') ?></p>

    <h2><?= $translations->get($translatPath . 'devTitle') ?></h2>

    <p><?= $translations->get($translatPath . 'devBody') ?></p>
</main>

</body>
</html>
