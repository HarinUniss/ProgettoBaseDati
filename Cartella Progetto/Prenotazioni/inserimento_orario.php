<?php session_start();//accedo alla variabile globale $_SESSION ?>
<!-- Fare in modo che una volta fatto il loghin la sessione resti aperta nelle altre pagine del sito! -->

<!DOCTYPE html>
<html>


<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/main.css"> <!--linko il css della HP-->
    <!--Includo la libreria di jQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="./script/funzioni_header.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>

    </script>
    <style>

    </style>


</head>

<?php
    $LApertura =  $MaApertura =  $MeApertura =  $GApertura =  $VApertura =  $SApertura = $DApertura =  "" ;
    $LChiusura =  $MaChiusura =  $MeChiusura =  $GChiusura =  $VChiusura =  $SChiusura = $DChiusura = "" ;

    $query_cambia_orario="UPDATE ";

?>



<body>

<div id="panel2" class="container-fluid" style="display: ">
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


        <button type="submit" name="butt_orari" >Salva Orariro</button>

    </form>


</div>





</body>
</html>
