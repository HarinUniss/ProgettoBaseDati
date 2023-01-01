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
    <!--Includo la libreria di jQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="./script/funzioni_header.js"></script>
</head>

<nobr>
<div class="head container-fluid" >
    <nobr>
        <!--<a class="h_img">
            <img src="./Immagini/imm_sito.jpg" width="45" height="45">
        </a>--><!---->

        <!--placeholder permette che all'inserimento lettera, Search Scompare-->
        <!--Invisibile si attiva premendo il bottone di ricerca vedi funzioni_jQuery-->
        <input type="text" id="baricerca" placeholder="search"><button id="butt_search"><img id="img_bt_src" src="./Immagini/search_icone.png" height="15" width="15"></button>

        <a class="login_button">
            <img id="prof" src="./Immagini/utente_img.png" height="25" width="25">
        </a>
    </nobr>
</div>
    <div class="login_div">

        <form method="post" action="<?php echo $_SERVER['PHP_SELF'];//Per fare riferimento a questo file?>">
            <p><button class="close btn btn-danger"> close </button>
            Inserisci credenziali<br>
            <input type="text" placeholder="email" name="email"><br>
            <input type="password" placeholder="password" name="password"><br><br>
            <button type="submit" class="btn btn-info">Invia</button><button id="cancella" class="btn btn-danger">Cancella</button></p>
            <p>Se non sei registrato: <a href="">Registrati</a></p>
        </form>
    </div>
    <?php
    /*//Consiglio vivamente di non attivarlo per ora
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $us_em = htmlspecialchars($_REQUEST['email']); //Assegnamento email
        $us_ps = htmlspecialchars($_REQUEST['password']); //Assegnamento password
        if(empty($us_em)){ //Funzione empty, controlla se l'elemento dato in argomento è vuoto
            echo "* email non inserita";
        }
        if(empty($us_ps)){
            echo "* password non inserita";
        }
        if(!empty($us_em) && !empty($us_ps)){
            $user = new User($us_em, $us_ps);

            echo "<p id='str_credenz'>Email inserita: ".$us_em." Password inserita: ".$us_ps."</p>";
        }
    }*/
    ?>


</html>