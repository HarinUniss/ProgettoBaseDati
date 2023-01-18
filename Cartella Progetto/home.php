<?php //session_start();//accedo alla variabile globale $_SESSION ?>
<!-- Fare in modo che una volta fatto il loghin la sessione resti aperta nelle altre pagine del sito! -->

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="./scss/main.css">
    <!-- Boxicons CSS -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

    <?php
    include_once('./Header/header.php');
    include_once('./Navigatore/nav.php');
    include_once('./Footer/footer.php');
    ?>
    <div id="blocco_pagina">
        <?php  include_once('./Contenuto Pagina/contenuto.php')?>
    </div>



</body>
</html>