<?php session_start();?>
<!DOCTYPE html>
<html lang = it>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Animali per amici</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!--Includo la libreria di jQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="./script/header.js"></script>

</head>


<nobr>
<div class="head container-fluid" >

    <!--placeholder permette che all'inserimento lettera, Search Scompare-->
    <!--Invisibile si attiva premendo il bottone di ricerca vedi funzioni_jQuery-->

    <button id="butt_search"><img id="img_bt_src" src="./Immagini/search_icone.png" height="15" width="15"></button>



    <?php
        $cdd = "";
        //Utile per il ripescaggio delle immagini nell'inclusione Quando richiamo
        //L'header in altre pagine...
        function setFotoUserLoggedDirectory($cd){
            $cdd = $cd;
        }
        $directory_foto = $cdd."./Immagini/utente_img.png";

        if (isset($_POST["logout"])){ //Se la richiesta arriva dal form di logout esegue questo
            session_unset(); //Rimuove ogni variabile di sessione create
            session_destroy(); //Distrugge la sessione
            echo '<script type="text/javascript">alert("logout effettuato, arrivederci")</script>';
        }
        $nome_utente = array_key_exists("nome_utente",$_SESSION) ? $_SESSION["nome_utente"] : "";
        $tipo = array_key_exists("tipo", $_SESSION)? $_SESSION["tipo"] : "";
        if($tipo == ""){
            echo "<a class='login_button' href='./Contenuto Pagina/login.php'>
                    <img id='prof' src='$directory_foto' height='30' width='30'>
                 </a>";
        }else{
            if(isset($_SESSION["foto"]) && $_SESSION["foto"] != "" && $_SESSION["foto"] != null){
                //Tolgo il primo . per poter essere localizzato nell'header
                if($cdd != ""){
                    $directory_foto = substr($cdd, 1).$_SESSION["foto"];
                }else{
                    $directory_foto = substr($_SESSION["foto"], 1);
                }
            }

            echo "
                <a class='login_button2'><img id='prof' src='$directory_foto' height='30' width='30'>".$_SESSION["nome_utente"]."</a>
                  <!--<p>$directory_foto</p>-->
                  <div class='tendina-login-button'>
                    <form method='post' action=''>
                        <dl>
                         <dt><a href='./Contenuto%20Pagina/registrazioneAnimale.php'>Inserisci animali</a></dt>
                         <dt><a href='./Contenuto Pagina/profiloUtente.php?user=".$_SESSION["id_utente"]."'>Profilo</a></dt>
                         <dt><a href='./Contenuto Pagina/paginaAnimaliInseriti.php'>Animali inseriti</a></dt>
                         <dt><button name = 'logout'>
                                Logout<i class='bx bx-log-out' ></i>
                            </button>
                         </dt>
                        </dl> 
                    </form>  
                  </div>";
        }
        ?>
</div>

</html>