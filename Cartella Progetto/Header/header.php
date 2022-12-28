<?php

?>
<!DOCTYPE html>
<html lang = it en>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Animali per amici</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/main.css"> <!--linko il css della HP-->
    <link rel="stylesheet" href="style_HomeP.css">
    <!--Includo la libreria di jQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="./script/funzioni_header.js"></script>
</head>
<body>
<nobr>
<div class="head container-fluid" >
    <nobr>
        <!--<a class="h_img">
            <img src="./Immagini/imm_sito.jpg" width="45" height="45">
        </a>-->

        <!--placeholder permette che all'inserimento lettera, Search Scompare-->
        <!--Invisibile si attiva premendo il bottone di ricerca vedi funzioni_jQuery-->
        <input type="text" id="baricerca" placeholder="Search"><button id="butt_search"><img id="img_bt_src" src="./Immagini/search_icone.png" height="15" width="15"></button>

        <a href="login.html" class="link">
            <img src="./Immagini/utente_img.png" height="25" width="25"> Login
        </a>
    </nobr>
</div>
</body>
</html>