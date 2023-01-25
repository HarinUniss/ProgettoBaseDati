<?php session_start();?>
<!DOCTYPE html>
<html>


<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script>

    </script>
    <style>
        #panel2{
            margin-top: 57px;

        }

    </style>


</head>

<?php
$LApertura =  $MaApertura =  $MeApertura =  $GApertura =  $VApertura =  $SApertura = $DApertura =  "" ;
$LChiusura =  $MaChiusura =  $MeChiusura =  $GChiusura =  $VChiusura =  $SChiusura = $DChiusura = "" ;
$ErroreOrario = $LErrore = $MaErrore = $MeErrore = $GErrore = $VErrore = $SErrore = $DErrore = "";
$Inserimento= [ 'lunedi', 'martedi','mercoledi' , 'giovedi', 'sabato' , 'domenica'];

$query_cambia_orario="";


//serve a verificare se un giorno è gia stato impostato per l'utente
function se_esiste_gia( $giorno ) {
    echo 'entro nella funzione';
    $connessione = new mysqli("localhost", "root", "", "db_progetto") or die("Connessione fallita: " . $connessione->connect_error); //streammo l'errore di connessione;

    $query_verifica = "SELECT * FROM orario_apertura WHERE giorno = '".$giorno."' AND id_azienda = '".$_SESSION['id_utente']."' ";

    $risultato = $connessione -> query($query_verifica);


    if( $risultato){
        return true;
    }
    return false;
}

function controllo_orario( $Apertura , $Chiusura ){
    $oraI = intval(substr($Apertura,0,2));
    $minI = intval(substr($Apertura,3,2));
    $oraF = intval(substr($Chiusura,0,2));
    $minF = intval(substr($Chiusura,3,2));

    if( $oraF - $oraI > 0 ){
        return true;
    }else if( $oraF - $oraI == 0 && $minF - $minI > 0 ){
        return true;
    }else{
        return false;
    }

}
function controllo_azzeramento_orario( $Apertura , $Chiusura ){
    $oraI = intval(substr($Apertura,0,2));
    $minI = intval(substr($Apertura,3,2));
    $oraF = intval(substr($Chiusura,0,2));
    $minF = intval(substr($Chiusura,3,2));

    if( $oraF - $oraI == 0 && $minF - $minI == 0 ){
        return true;
    }else{
        return false;
    }

}





// ritorno alla home se non si è loggati
if( !isset($_SESSION[ "id_utente" ] ) ){
    header( "location: ../home.php");
}else{

    //prendiamo input inseriti dall'utente
    if( isset($_POST["butt_salva_orario"] )){

        if( isset($_POST["LApertura"]) && isset($_POST["LChiusura"])   ){



                if( controllo_orario( $_POST["LApertura"] , $_POST["LChiusura"] )){
//                    echo "LUNEDI GIUSTO!!!   ";
                    $LApertura = substr( $_POST["LApertura"],0,5) ;
                    $LChiusura = substr( $_POST["LChiusura"],0,5) ;
                }else if ( controllo_azzeramento_orario( $_POST["LApertura"] , $_POST["LChiusura"] )){
                    $LApertura = substr( $_POST["LApertura"],0,5) ;
                    $LChiusura = substr( $_POST["LChiusura"],0,5) ;
                }else{

                    $LErrore = "Oraro chiusura non può essere minore di quello di appertura!!!";
                }


        }
//      else if( !isset($_POST["LApertura"]) && !isset($_POST["LChiusura"])){
////                tengo a nul gli orari
////                $LApertura = "";
////                $LChiusura = "";
//
//        }else{
//            $LErrore = "Orari lunedi non inseriti";
//        }

        //MARTEDI
        if( isset($_POST["MaApertura"]) && isset($_POST["MaChiusura"])   ){


            if( controllo_orario( $_POST["MaApertura"] , $_POST["MaChiusura"] ) ){
//                echo "MARTEDI GIUSTO!!!   ";
                $MaApertura = substr( $_POST["MaApertura"],0,5);
                $MaChiusura = substr( $_POST["MaChiusura"],0,5);

            }else if ( controllo_azzeramento_orario( $_POST["MaApertura"] , $_POST["MaChiusura"] )){
                $MaApertura = substr( $_POST["MaApertura"],0,5);
                $MaChiusura = substr( $_POST["MaChiusura"],0,5);
            }else{

                $MaErrore = "Oraro chiusura non può essere minore di quello di appertura!!!";
            }

        }
//        else if( !isset($_POST["MaApertura"]) && !isset($_POST["MaChiusura"])){
////                tengo a nul gli orari
////                $MaApertura = "";
////                $MaChiusura = "";
//
//        }else{
//            $MaErrore = "Orari Martedi non inseriti";
//        }

        //MERCOLEDI
        if( isset($_POST["MeApertura"]) && isset($_POST["MeChiusura"])   ){


            if( controllo_orario( $_POST["MeApertura"] , $_POST["MeChiusura"] ) ){
//                echo "MERCOLEDI GIUSTO!!!   ";
                $MeApertura = substr( $_POST["MeApertura"],0,5) ;
                $MeChiusura = substr( $_POST["MeChiusura"],0,5) ;

            }else if ( controllo_azzeramento_orario( $_POST["MeApertura"] , $_POST["MeChiusura"] )){
                $MeApertura = substr( $_POST["MeApertura"],0,5) ;
                $MeChiusura = substr( $_POST["MeChiusura"],0,5) ;
            }else{
                $MeErrore = "Oraro chiusura non può essere minore di quello di appertura!!!";
            }

        }
//        else if( !isset($_POST["MeApertura"]) && !isset($_POST["MeChiusura"])){
////                tengo a nul gli orari
////                $MeApertura = "";
////                $MeChiusura = "";
//
//        }else{
//            $MeErrore = "Orari Mercoledi non inseriti";
//        }

        //GIOVEDI
        if( isset($_POST["GApertura"]) && isset($_POST["GChiusura"])   ){

            if( controllo_orario( $_POST["GApertura"] , $_POST["GChiusura"] ) ){
//                echo "GIOVEDI GIUSTO!!!   ";
                $GApertura = substr( $_POST["GApertura"],0,5) ;
                $GChiusura = substr( $_POST["GChiusura"],0,5) ;

            }else if ( controllo_azzeramento_orario( $_POST["GApertura"] , $_POST["GChiusura"] )){
                $GApertura = substr( $_POST["GApertura"],0,5) ;
                $GChiusura = substr( $_POST["GChiusura"],0,5) ;
            }else{
                $GErrore = "Oraro chiusura non può essere minore di quello di appertura!!!";
            }

        }
//        else if( !isset($_POST["GApertura"]) && !isset($_POST["GChiusura"])){
////                tengo a nul gli orari
////                $GApertura = "";
////                $GChiusura = "";
//
//        }else{
//            $GErrore = "Orari Giovedi non inseriti";
//        }
//

        //VENERDI
        if( isset($_POST["VApertura"]) && isset($_POST["VChiusura"])   ){

            if( controllo_orario( $_POST["VApertura"] , $_POST["VChiusura"] ) ){
//                echo "VENERDI GIUSTO!!!   ";
                $VApertura = substr( $_POST["VApertura"],0,5) ;
                $VChiusura = substr( $_POST["VChiusura"],0,5) ;
            }else if ( controllo_azzeramento_orario(  $_POST["VApertura"] , $_POST["VChiusura"] )){
                $VApertura = substr( $_POST["VApertura"],0,5) ;
                $VChiusura = substr( $_POST["VChiusura"],0,5) ;
            }else{
                $VErrore = "Oraro chiusura non può essere minore di quello di appertura!!!";
            }

        }
//        else if( !isset($_POST["VApertura"]) && !isset($_POST["VChiusura"])){
////                tengo a nul gli orari
////                $VApertura = "";
////                $VChiusura = "";
//
//        }else{
//            $VErrore = "Orari Venerdi non inseriti";
//        }

        //SABATO
        if( isset($_POST["SApertura"]) && isset($_POST["SChiusura"])   ){

            if( controllo_orario( $_POST["SApertura"] , $_POST["SChiusura"] ) ){
//                echo "SABATO GIUSTO!!!   ";
                $SApertura = substr( $_POST["SApertura"],0,5);
                $SChiusura = substr( $_POST["SChiusura"],0,5);
            }else if ( controllo_azzeramento_orario( $_POST["SApertura"] , $_POST["SChiusura"] )){
                $SApertura = substr( $_POST["SApertura"],0,5);
                $SChiusura = substr( $_POST["SChiusura"],0,5);
            }else{
                $SErrore = "Oraro chiusura non può essere minore di quello di appertura!!!";
            }

        }
//        else if( !isset($_POST["SApertura"]) && !isset($_POST["SChiusura"])){
////                tengo a nul gli orari
////                $SApertura = "";
////                $SChiusura = "";
//
//        }else{
//            $SErrore = "Orari Sabato non inseriti";
//        }


        //DOMENICA
        if( isset($_POST["DApertura"]) && isset($_POST["DChiusura"])  ){

            if( controllo_orario( $_POST["GApertura"] , $_POST["GChiusura"] ) ){
//                echo "DOMENICA GIUSTO!!!   ";
                $DApertura = substr( $_POST["DApertura"],0,5);
                $DChiusura = substr( $_POST["DChiusura"],0,5);
            }else if ( controllo_azzeramento_orario( $_POST["GApertura"] , $_POST["GChiusura"] )){
                $DApertura = substr( $_POST["DApertura"],0,5);
                $DChiusura = substr( $_POST["DChiusura"],0,5);
            }else{
                $DErrore = "Oraro chiusura non può essere minore di quello di appertura!!!";
            }

        }
//        else if( !isset($_POST["DApertura"]) && !isset($_POST["DChiusura"])){
////                tengo a nul gli orari
////                $DApertura = "";
////                $DChiusura = "";
//
//        }else{
//            $DErrore = "Orari Domenica non inseriti";
//        }



        $ErroreOrario = $LErrore.$MaErrore.$MeErrore.$GErrore.$VErrore.$SErrore.$DErrore;

        if( $ErroreOrario != "" ){

            echo '<script> alert("Errore inserimento orario"); </script>';


        } else {//CARICAMENTO SUL DATABASE
            $connessione = new mysqli("localhost", "root", "", "db_progetto") or die("Connessione fallita: " . $connessione->connect_error); //streammo l'errore di connessione;

            if($LApertura != "" ){
                if( se_esiste_gia("lunedi")  ){
                    echo 'query di update!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!';
                    $query_orario_lunedi=" UPDATE orario_apertura  SET ora_inizio = '$LApertura' , ora_fine = '$LChiusura'  WHERE id_azienda = '".$_SESSION["id_utente"]."' AND giorno = 'lunedi' ";
                }else{
                    $query_orario_lunedi=" INSERT INTO orario_apertura ( id_azienda , giorno , ora_inizio , ora_fine  ) VALUES  ( '".$_SESSION["id_utente"]."' , 'lunedi' , '$LApertura' , '$LChiusura'  )";
                }
                $connessione ->query( $query_orario_lunedi) or die("Errore query_orario_lunedi");
                $Inserimento = "true";


            }

            if($MaApertura != "" ){
                if( se_esiste_gia("martedi") ){
                    $query_orario_martedi=" UPDATE orario_apertura  SET ora_inizio = '$MaApertura' , ora_fine = '$MaChiusura'  WHERE id_azienda = '".$_SESSION["id_utente"]."' AND giorno = 'martedi' ";
                }else{
                    $query_orario_martedi=" INSERT INTO orario_apertura ( id_azienda , giorno , ora_inizio , ora_fine  ) VALUES  ( '".$_SESSION["id_utente"]."' , 'martedi' , '$MaApertura' , '$MaChiusura'  )";
                }
                $connessione ->query( $query_orario_martedi) or die("Errore query_orario_martedi");
                $Inserimento = "true";
            }

            if($MeApertura != "" ){
                if( se_esiste_gia("mercoledi") ){
                    $query_orario_mercoledi=" UPDATE orario_apertura  SET ora_inizio = '$MeApertura' , ora_fine = '$MeChiusura'  WHERE id_azienda = '".$_SESSION["id_utente"]."' AND giorno = 'mercoledi' ";
                }else{
                    $query_orario_mercoledi=" INSERT INTO orario_apertura ( id_azienda , giorno , ora_inizio , ora_fine  ) VALUES  ( '".$_SESSION["id_utente"]."' , 'mercoledi' , '$MeApertura' , '$MeChiusura'  )";
                }
                $connessione ->query( $query_orario_mercoledi) or die("Errore query_orario_mercoledi");
                $Inserimento = "true";
            }

            if($GApertura != "" ){
                if( se_esiste_gia("giovedi") ){
                    $query_orario_giovedi=" UPDATE orario_apertura  SET ora_inizio = '$GApertura' , ora_fine = '$GChiusura'  WHERE id_azienda = '".$_SESSION["id_utente"]."' AND giorno = 'giovedi' ";
                }else{
                    $query_orario_giovedi=" INSERT INTO orario_apertura ( id_azienda , giorno , ora_inizio , ora_fine  ) VALUES  ( '".$_SESSION["id_utente"]."' , 'giovedi' , '$GApertura' , '$GChiusura'  )";
                }

                $connessione ->query( $query_orario_giovedi) or die("Errore query_orario_giovedi");
                $Inserimento = "true";
            }


            if($VApertura != "" ){
                if( se_esiste_gia("venerdi") ){
                    $query_orario_venerdi=" UPDATE orario_apertura  SET ora_inizio = '$VApertura' , ora_fine = '$VChiusura'  WHERE id_azienda = '".$_SESSION["id_utente"]."' AND giorno = 'venerdi' ";
                }else{
                    $query_orario_venerdi=" INSERT INTO orario_apertura ( id_azienda , giorno , ora_inizio , ora_fine  ) VALUES  ( '".$_SESSION["id_utente"]."' , 'venerdi' , '$VApertura' , '$VChiusura'  )";
                }
                $connessione ->query( $query_orario_venerdi) or die("Errore query_orario_venerdi");
                $Inserimento = "true";
            }



            if($SApertura != "" ){
                if( se_esiste_gia("sabato") ){
                    $query_orario_sabato=" UPDATE orario_apertura  SET ora_inizio = '$SApertura' , ora_fine = '$SChiusura'  WHERE id_azienda = '".$_SESSION["id_utente"]."' AND giorno = 'sabato' ";
                }else{
                    $query_orario_sabato=" INSERT INTO orario_apertura ( id_azienda , giorno , ora_inizio , ora_fine  ) VALUES  ( '".$_SESSION["id_utente"]."' , 'sabato' , '$SApertura' , '$SChiusura'  )";
                }
                $connessione ->query( $query_orario_sabato) or die("Errore query_orario_sabato");
                $Inserimento = "true";
            }

            if($DApertura != "" ){
                if( se_esiste_gia("domenica") ){
                    $query_orario_domenica=" UPDATE orario_apertura  SET ora_inizio = '$DApertura' , ora_fine = '$DChiusura'  WHERE id_azienda = '".$_SESSION["id_utente"]."' AND giorno = 'domenica' ";
                }else{
                    $query_orario_domenica=" INSERT INTO orario_apertura ( id_azienda , giorno , ora_inizio , ora_fine  ) VALUES  ( '".$_SESSION["id_utente"]."' , 'domenica' , '$DApertura' , '$DChiusura'  )";
                }
                $connessione ->query( $query_orario_domenica) or die("Errore query_orario_domenica");
                $Inserimento = "true";
            }



            if($Inserimento == "true"){
                echo '<script> alert("Le modifiche sono state apportate con successo ");
                        window.location.href="../home.php";
                       </script>';
            }

        }






    }


}





?>

<body>

<div id="panel2" class="container bg-warning p-5" style="display: ">
    <form class="col" id="inserimento_orari" name="orario" method="post" action="">

        <div class="row">
            <div class=" col form-group">
                <label class="active" for="timeStandard">Lunedi Apertura</label>
                <input class="form-control" name="LApertura" id="timeStandard" type="time">
            </div>
            <div class=" col form-group">
                <label class="active" for="timeStandard">Lunedi Chiusura</label>
                <input class="form-control" name="LChiusura" id="timeStandard" type="time">
            </div>
        </div>
        <?php
        echo"<a class='error'> ".$LErrore." </a>"
        ?>

        <div class="row">
            <div class=" col form-group">
                <label class="active" for="timeStandard">Martedi Apertura</label>
                <input class="form-control" name="MaApertura" id="timeStandard" type="time">
            </div>
            <div class=" col form-group">
                <label class="active" for="timeStandard">Martedi Chiusura</label>
                <input class="form-control" name="MaChiusura" id="timeStandard" type="time">
            </div>
        </div>
        <?php
        echo"<a class='error'> ".$MaErrore." </a>"
        ?>

        <div class="row">
            <div class=" col form-group">
                <label class="active" for="timeStandard">Mercoledi Apertura</label>
                <input class="form-control" name="MeApertura" id="timeStandard" type="time">
            </div>
            <div class=" col form-group">
                <label class="active" for="timeStandard">Mercoledi Chiusura</label>
                <input class="form-control" name="MeChiusura" id="timeStandard" type="time">
            </div>
        </div>
        <?php
        echo"<a class='error'> ".$MeErrore." </a>"
        ?>

        <div class="row">
            <div class=" col form-group">
                <label class="active" for="timeStandard">Giovedi Apertura</label>
                <input class="form-control" name="GApertura" id="timeStandard" type="time">
            </div>
            <div class=" col form-group">
                <label class="active" for="timeStandard">Giovedi Chiusura</label>
                <input class="form-control" name="GChiusura" id="timeStandard" type="time">
            </div>
        </div>
        <?php
        echo"<a class='error'> ".$GErrore." </a>"
        ?>

        <div class="row">
            <div class=" col form-group">
                <label class="active" for="timeStandard">Venerdi Apertura</label>
                <input class="form-control" name="VApertura" id="timeStandard" type="time">
            </div>
            <div class=" col form-group">
                <label class="active" for="timeStandard">Venerdi Chiusura</label>
                <input class="form-control" name="VChiusura" id="timeStandard" type="time">
            </div>
        </div>
        <?php
        echo"<a class='error'> ".$VErrore." </a>"
        ?>

        <div class="row">
            <div class=" col form-group">
                <label class="active" for="timeStandard">Sabato Apertura</label>
                <input class="form-control" name="SApertura" id="timeStandard" type="time">
            </div>
            <div class=" col form-group">
                <label class="active" for="timeStandard">Sabato Chiusura</label>
                <input class="form-control" name="SChiusura" id="timeStandard" type="time">
            </div>
        </div>
        <?php
        echo"<a class='error'> ".$SErrore." </a>"
        ?>

        <div class="row">
            <div class=" col form-group">
                <label class="active" for="timeStandard">Domenica Apertura</label>
                <input class="form-control" name="DApertura" id="timeStandard" type="time">
            </div>
            <div class=" col form-group">
                <label class="active" for="timeStandard">Domenica Chiusura</label>
                <input class="form-control" name="DChiusura" id="timeStandard" type="time">
            </div>
        </div>
        <?php
        echo"<a class='error'> ".$DErrore." </a>"
        ?>


        <button type="submit" name="butt_salva_orario" >Salva Orario</button>

    </form>


</div>





</body>
</html>