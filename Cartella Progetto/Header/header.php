<?php session_start();?>
<!DOCTYPE html>
<html lang = it>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Animali per amici</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!--Includo la libreria di jQuery-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="./script/header.js"></script>

</head>


<nobr>
<div class="head container-fluid" >

    <!--placeholder permette che all'inserimento lettera, Search Scompare-->
    <!--Invisibile si attiva premendo il bottone di ricerca vedi funzioni_jQuery-->

    <button id="butt_search"><img id="img_bt_src" src="./Immagini/search_icone.png" height="20" width="20"></button>



    <?php
        $cdd = "";
        //Utile per il ripescaggio delle immagini nell'inclusione Quando richiamo
        //L'header in altre pagine...
        function setFotoUserLoggedDirectory($cd){
            $cdd = $cd;
        }
        $directory_foto = $cdd."./Immagini/utente_img.png";


        $nome_utente = array_key_exists("nome_utente",$_SESSION) ? $_SESSION["nome_utente"] : "";
        $tipo = array_key_exists("tipo", $_SESSION)? $_SESSION["tipo"] : "";
        if($tipo == ""){
            echo "<button class='login_button' onclick='goToLoginPage()'><img id='prof' src='$directory_foto' height='25' width='25'></button>";
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
                <button class='login_button2'><img id='prof' src='$directory_foto' height='30' width='30'>".$_SESSION["nome_utente"]."</button>
                  <!--<p>$directory_foto</p>-->
                  <div class='tendina-login-button'>
                    <form method='post' action=''>
                        <dl>
                         <dt><a href='./Contenuto Pagina/profiloUtente.php?user=".$_SESSION["id_utente"]."'>Profilo</a></dt>
                         <dt><a href='./Contenuto%20Pagina/registrazioneAnimale.php'>Inserisci animali</a></dt>
                         <dt><a href='./Contenuto Pagina/paginaAnimaliInseriti.php'>Animali inseriti</a></dt>
                         ";
            if($tipo== "canile" || $tipo == "allevamento" ){
                echo '  <dt>Gestione Appuntamenti</dt>
                        <dt><a href="">Visualizza Appuntamenti</a></dt>
                        <!--<dt><button id="butt_imposta_orario" class="btn btn-light" onclick="goToInserimentoOrario()"><i class="bx bxs-calendar-alt">Imposta Orari</i></button></dt>-->
                        <dt><a href="./Prenotazioni/inserimento_orario.php"><i class="bx bxs-calendar-alt"></i>Imposta Orari</a></dt>
                        ';
            }elseif($tipo=="utente"){
                echo '<dt>Gestione Prenotazioni</dt>
                      <dt><a href="">Visualizza Prenotazioni</a></dt>
                ';
            }
                         echo"<dt><a href='Header/logout.php?logout=1'>
                                Logout<i class='bx bx-log-out' ></i>
                            </a>
                         </dt>
                        </dl> 
                    </form>  
                  </div>";
        }
        ?>
</div>

</html>