<?php
include '../../src/controler/session.php';
$translations = $_SESSION['translations'];
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
    <p><?= $translations->get('global.navbar.about') ?></p>
</main>
</body>
</html>