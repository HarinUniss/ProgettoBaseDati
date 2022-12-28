<?php

?>
<!DOCTYPE html>
<html lang = it en>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Animali per amici</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style_HomeP.css"> <!--linko il css della HP-->
    <!--Includo la libreria di jQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="funzioni_HomePage.js"></script>
</head>
<body>
<nobr>
<div class="head" >
    <nobr>
        <a class="h_img">
            <img src="imm_sito.jpg" width="45" height="45">
        </a>

        <!--placeholder permette che all'inserimento lettera, Search Scompare-->
        <!--Invisibile si attiva premendo il bottone di ricerca vedi funzioni_jQuery-->
        <!--<div class="ricerca">-->
            <input type="text" id="baricerca" placeholder="Search"><button id="butt_search"><img id="img_bt_src" src="search_icone.png" height="15" width="15"></button>
        <!--</div>-->
        <a href="login.html" class="link">
            <img src="utente_img.png" height="10" width="10"> Login <!--No br altrimenti si separa img da login-->
        </a>
    </nobr>
</div>

<div class="barra_sinistra"></div>
<div class="div container-fluid">
    <div class="row">

    </div>
</div>
</body>
</html>