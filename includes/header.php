<?php
// includes/header.php
function isActive($page) {
    return basename($_SERVER['PHP_SELF']) == $page ? 'active' : '';
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noroi no Kiroku</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="scroll-container">
        <header>
            <h1><a href="index.php">Noroi no Kiroku</a></h1>
            <nav>
                <ul>
                    <li class="<?php echo isActive('index.php'); ?>"><a href="index.php">Главная</a></li>
                    <li class="<?php echo isActive('creatures.php'); ?>"><a href="creatures.php">Существа</a></li>
                    <li class="<?php echo isActive('deities.php'); ?>"><a href="deities.php">Божества</a></li>
                    <li class="<?php echo isActive('objects.php'); ?>"><a href="objects.php">Проклятые объекты</a></li>
                </ul>
            </nav>
        </header>
        <main>