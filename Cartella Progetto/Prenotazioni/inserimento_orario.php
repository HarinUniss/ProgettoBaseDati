
<!DOCTYPE html>
<html>


<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!--linko il css della HP-->
    <!--Includo la libreria di jQuery-->

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

// ritorno alla home se non si è loggati
if( !isset($_SESSION[ "id_utente" ] ) ){

}else{

    //prendiamo input inseriti dall'utente
    if( isset($_POST["butt_salva_orario"] )){

        if( isset($_POST["LApertura"]) && isset($_POST["LChiusura"])   ){

            if( $_POST["LApertura"] < $_POST["LChiusura"] ){
                $LApertura = $_POST["LApertura"];
                $LChiusura = $_POST["LChiusura"];
            }else{
                $LErrore = "Oraro chiusura non può essere minore di quello di appertura!!!";
            }


        }else if( !isset($_POST["LApertura"]) && !isset($_POST["LChiusura"])){
//                tengo a nul gli orari
//                $LApertura = "";
//                $LChiusura = "";

        }else{
            $LErrore = "Orari lunedi non inseriti";
        }

        if( isset($_POST["MaApertura"]) && isset($_POST["MaChiusura"])   ){


            if( $_POST["MaApertura"] < $_POST["MaChiusura"] ){
                $MaApertura = $_POST["MaApertura"];
                $MaChiusura = $_POST["MaChiusura"];
            }else{
                $LErrore = "Oraro chiusura non può essere minore di quello di appertura!!!";
            }

        }else if( !isset($_POST["MaApertura"]) && !isset($_POST["MaChiusura"])){
//                tengo a nul gli orari
//                $MaApertura = "";
//                $MaChiusura = "";

        }else{
            $MaErrore = "Orari Martedi non inseriti";
        }

        if( isset($_POST["MeApertura"]) && isset($_POST["MeChiusura"])   ){


            if( $_POST["MeApertura"] < $_POST["MeChiusura"] ){
                $MeApertura = $_POST["MeApertura"];
                $MeChiusura = $_POST["MeChiusura"];

            }else{
                $LErrore = "Oraro chiusura non può essere minore di quello di appertura!!!";
            }

        }else if( !isset($_POST["MeApertura"]) && !isset($_POST["MeChiusura"])){
//                tengo a nul gli orari
//                $MeApertura = "";
//                $MeChiusura = "";

        }else{
            $MeErrore = "Orari Mercoledi non inseriti";
        }


        if( isset($_POST["GApertura"]) && isset($_POST["GChiusura"])   ){

            if( $_POST["GApertura"] < $_POST["GChiusura"] ){
                $GApertura = $_POST["GApertura"];
                $GChiusura = $_POST["GChiusura"];

            }else{
                $LErrore = "Oraro chiusura non può essere minore di quello di appertura!!!";
            }

        }else if( !isset($_POST["GApertura"]) && !isset($_POST["GChiusura"])){
//                tengo a nul gli orari
//                $GApertura = "";
//                $GChiusura = "";

        }else{
            $GErrore = "Orari Giovedi non inseriti";
        }



        if( isset($_POST["VApertura"]) && isset($_POST["VChiusura"])   ){

            if( $_POST["VApertura"] < $_POST["VChiusura"] ){
                $VApertura = $_POST["VApertura"];
                $VChiusura = $_POST["VChiusura"];
            }else{
                $LErrore = "Oraro chiusura non può essere minore di quello di appertura!!!";
            }

        }else if( !isset($_POST["VApertura"]) && !isset($_POST["VChiusura"])){
//                tengo a nul gli orari
//                $VApertura = "";
//                $VChiusura = "";

        }else{
            $VErrore = "Orari Venerdi non inseriti";
        }


        if( isset($_POST["SApertura"]) && isset($_POST["SChiusura"])   ){

            if( $_POST["SApertura"] < $_POST["SChiusura"] ){
                $SApertura = $_POST["SApertura"];
                $SChiusura = $_POST["SChiusura"];
            }else{
                $LErrore = "Oraro chiusura non può essere minore di quello di appertura!!!";
            }

        }else if( !isset($_POST["SApertura"]) && !isset($_POST["SChiusura"])){
//                tengo a nul gli orari
//                $SApertura = "";
//                $SChiusura = "";

        }else{
            $SErrore = "Orari Sabato non inseriti";
        }

        if( isset($_POST["DApertura"]) && isset($_POST["DChiusura"])   ){

            if( $_POST["DApertura"] < $_POST["DChiusura"] ){
                $SApertura = $_POST["DApertura"];
                $SChiusura = $_POST["DChiusura"];
            }else{
                $LErrore = "Oraro chiusura non può essere minore di quello di appertura!!!";
            }

        }else if( !isset($_POST["DApertura"]) && !isset($_POST["DChiusura"])){
//                tengo a nul gli orari
//                $DApertura = "";
//                $DChiusura = "";

        }else{
            $DErrore = "Orari Domenica non inseriti";
        }

        $ErroreOrario = $LErrore.$MaErrore.$MeErrore.$GErrore.$VErrore.$SErrore.$DErrore;

        if( $ErroreOrario != ""){
            echo '<script> alert("Errore inserimento orario"); </script>';
        }



        //CARICAMENTO SUL DATABASE
        else {
            $connessione = new mysqli("localhost", "root", "", "db_progetto") or die("Connessione fallita: " . $connessione->connect_error); //streammo l'errore di connessione;

            if($LApertura != "" ){
                $query_orario_lunedi=" INSERT INTO orario_apertura ( id_azienda , giorno , ora_inizio , ora_fine  ) VALUES  ( '".$_SESSION["id_utente"]."' , 'lunedi' , '$LApertura' , '$LChiusura'  )";
                $connessione ->query( $query_orario_lunedi) or die("Errore query_orario_lunedi");
                $Inserimento = "true";
            }

            if($MaApertura != "" ){
                $query_orario_martedi=" INSERT INTO orario_apertura ( id_azienda , giorno , ora_inizio , ora_fine  ) VALUES  ( '".$_SESSION["id_utente"]."' , 'martedi' , '$MaApertura' , '$MaChiusura'  )";
                $connessione ->query( $query_orario_martedi) or die("Errore query_orario_martedi");
                $Inserimento = "true";
            }

            if($MeApertura != "" ){
                $query_orario_mercoledi=" INSERT INTO orario_apertura ( id_azienda , giorno , ora_inizio , ora_fine  ) VALUES  ( '".$_SESSION["id_utente"]."' , 'mercoledi' , '$MeApertura' , '$MeChiusura'  )";
                $connessione ->query( $query_orario_mercoledi) or die("Errore query_orario_mercoledi");
                $Inserimento = "true";
            }

            if($GApertura != "" ){
                $query_orario_giovedi=" INSERT INTO orario_apertura ( id_azienda , giorno , ora_inizio , ora_fine  ) VALUES  ( '".$_SESSION["id_utente"]."' , 'giovedi' , '$GApertura' , '$GChiusura'  )";
                $connessione ->query( $query_orario_giovedi) or die("Errore query_orario_giovedi");
                $Inserimento = "true";
            }


            if($VApertura != "" ){
                $query_orario_venerdi=" INSERT INTO orario_apertura ( id_azienda , giorno , ora_inizio , ora_fine  ) VALUES  ( '".$_SESSION["id_utente"]."' , 'venerdi' , '$VApertura' , '$VChiusura'  )";
                $connessione ->query( $query_orario_venerdi) or die("Errore query_orario_venerdi");
                $Inserimento = "true";
            }



            if($SApertura != "" ){
                $query_orario_sabato=" INSERT INTO orario_apertura ( id_azienda , giorno , ora_inizio , ora_fine  ) VALUES  ( '".$_SESSION["id_utente"]."' , 'sabato' , '$SApertura' , '$SChiusura'  )";
                $connessione ->query( $query_orario_sabato) or die("Errore query_orario_sabato");
                $Inserimento = "true";
            }

            if($DApertura != "" ){
                $query_orario_domenica=" INSERT INTO orario_apertura ( id_azienda , giorno , ora_inizio , ora_fine  ) VALUES  ( '".$_SESSION["id_utente"]."' , 'domenica' , '$DApertura' , '$DChiusura'  )";
                $connessione ->query( $query_orario_domenica) or die("Errore query_orario_domenica");
                $Inserimento = "true";
            }



            if($Inserimento != ""){
                echo '<script> alert("Le modifiche sono state apportate con successo ") </script>';
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
                <input class="form-control" id="timeStandard" type="time">
            </div>
            <div class=" col form-group">
                <label class="active" for="timeStandard">Martedi Chiusura</label>
                <input class="form-control" id="timeStandard" type="time">
            </div>
        </div>
        <?php
        echo"<a class='error'> ".$MaErrore." </a>"
        ?>

        <div class="row">
            <div class=" col form-group">
                <label class="active" for="timeStandard">Mercoledi Apertura</label>
                <input class="form-control" id="timeStandard" type="time">
            </div>
            <div class=" col form-group">
                <label class="active" for="timeStandard">Mercoledi Chiusura</label>
                <input class="form-control" id="timeStandard" type="time">
            </div>
        </div>
        <?php
        echo"<a class='error'> ".$MeErrore." </a>"
        ?>

        <div class="row">
            <div class=" col form-group">
                <label class="active" for="timeStandard">Giovedi Apertura</label>
                <input class="form-control" id="timeStandard" type="time">
            </div>
            <div class=" col form-group">
                <label class="active" for="timeStandard">Giovedi Chiusura</label>
                <input class="form-control" id="timeStandard" type="time">
            </div>
        </div>
        <?php
        echo"<a class='error'> ".$GErrore." </a>"
        ?>

        <div class="row">
            <div class=" col form-group">
                <label class="active" for="timeStandard">Venerdi Apertura</label>
                <input class="form-control" id="timeStandard" type="time">
            </div>
            <div class=" col form-group">
                <label class="active" for="timeStandard">Venerdi Chiusura</label>
                <input class="form-control" id="timeStandard" type="time">
            </div>
        </div>
        <?php
        echo"<a class='error'> ".$VErrore." </a>"
        ?>

        <div class="row">
            <div class=" col form-group">
                <label class="active" for="timeStandard">Sabato Apertura</label>
                <input class="form-control" id="timeStandard" type="time">
            </div>
            <div class=" col form-group">
                <label class="active" for="timeStandard">Sabato Chiusura</label>
                <input class="form-control" id="timeStandard" type="time">
            </div>
        </div>
        <?php
        echo"<a class='error'> ".$SErrore." </a>"
        ?>

        <div class="row">
            <div class=" col form-group">
                <label class="active" for="timeStandard">Domenica Apertura</label>
                <input class="form-control" id="timeStandard" type="time">
            </div>
            <div class=" col form-group">
                <label class="active" for="timeStandard">Domenica Chiusura</label>
                <input class="form-control" id="timeStandard" type="time">
            </div>
        </div>
        <?php
        echo"<a class='error'> ".$DErrore." </a>"
        ?>


        <button type="submit" name="butt_salva_orario" >Salva Orariro</button>

    </form>


</div>





</body>
</html>