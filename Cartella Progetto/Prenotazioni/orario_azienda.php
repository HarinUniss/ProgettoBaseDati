
<!DOCTYPE html>
<html>


<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script>

    </script>
    <style>

    </style>


</head>

<?php


if( isset($_GET['id_utente'])){
    $id_utente = $_GET['id_utente'];
}
$Ricerca = "";
$connessione = new mysqli("localhost", "root", "", "db_progetto") or die("Errore accesso database " . $connessione->error);
$ricerca_orario_azienda = "SELECT *  FROM orario_apertura WHERE id_azienda ='".$id_utente."';";
$tabella_orario = $connessione -> query( $ricerca_orario_azienda );
$giorno_trovato = false;

?>

<table class="table">
    <thead>
    <tr class="table">
        <th scope="col " class="bg-secondary">Giorno</th>
        <th scope="col" class="bg-secondary">Apertura</th>
        <th scope="col" class="bg-secondary">Chiusura</th>


    </tr>
    </thead>
    <tbody>
    <tr>
        <th scope="row" class="bg-secondary">Lunedi</th>
        <?php
        if( mysqli_num_rows( $tabella_orario) > 0){
            while ( $riga = $tabella_orario->fetch_assoc() ){
                if( $riga['giorno'] == 'lunedi'){
                    echo "<td> ".$riga['ora_inizio']."</td>";
                    echo "<td> ".$riga['ora_fine']."</td>";
                    $giorno_trovato= true;
                }
            }
            if( $giorno_trovato == false){
                echo "<td> --- </td>";
                echo "<td> --- </td>";
            }
        }
        $giorno_trovato= false;
        ?>
    </tr>
    <tr>
        <th scope="row" class="bg-secondary">Martedi</th>
        <?php
        if( mysqli_num_rows( $tabella_orario) > 0){
            while ( $riga = $tabella_orario->fetch_assoc() ){
                if( $riga['giorno'] == 'Martedi'){
                    echo "<td> ".$riga['ora_inizio']."</td>";
                    echo "<td> ".$riga['ora_fine']."</td>";
                    $giorno_trovato= true;
                }
            }
            if( $giorno_trovato == false){
                echo "<td> --- </td>";
                echo "<td> --- </td>";
            }
        }
        $giorno_trovato= false;
        ?>
    </tr>
    <tr>
        <th scope="row" class="bg-secondary">Mercoledi</th>
        <?php
        if( mysqli_num_rows( $tabella_orario) > 0){
            while ( $riga = $tabella_orario->fetch_assoc() ){
                if( $riga['giorno'] == 'Mercoledi'){
                    echo "<td> ".$riga['ora_inizio']."</td>";
                    echo "<td> ".$riga['ora_fine']."</td>";
                    $giorno_trovato= true;
                }
            }
            if( $giorno_trovato == false){
                echo "<td> --- </td>";
                echo "<td> --- </td>";
            }
        }
        $giorno_trovato= false;
        ?>
    </tr>
    <tr>
        <th scope="row" class="bg-secondary">Giovedi</th>
        <?php
        if( mysqli_num_rows( $tabella_orario) > 0){
            while ( $riga = $tabella_orario->fetch_assoc() ){
                if( $riga['giorno'] == 'Giovedi'){
                    echo "<td> ".$riga['ora_inizio']."</td>";
                    echo "<td> ".$riga['ora_fine']."</td>";
                    $giorno_trovato= true;
                }
            }
            if( $giorno_trovato == false){
                echo "<td> --- </td>";
                echo "<td> --- </td>";
            }
        }
        $giorno_trovato= false;
        ?>
    </tr>
    <tr>
        <th scope="row" class="bg-secondary">Venerdi</th>
        <?php
        if( mysqli_num_rows( $tabella_orario) > 0){
            while ( $riga = $tabella_orario->fetch_assoc() ){
                if( $riga['giorno'] == 'Venerdi'){
                    echo "<td> ".$riga['ora_inizio']."</td>";
                    echo "<td> ".$riga['ora_fine']."</td>";
                    $giorno_trovato= true;
                }
            }
            if( $giorno_trovato == false){
                echo "<td> --- </td>";
                echo "<td> --- </td>";
            }
        }
        $giorno_trovato= false;
        ?>
    </tr>
    <tr>
        <th scope="row" class="bg-secondary">Sabato</th>
        <?php
        if( mysqli_num_rows( $tabella_orario) > 0){
            while ( $riga = $tabella_orario->fetch_assoc() ){
                if( $riga['giorno'] == 'Sabato'){
                    echo "<td> ".$riga['ora_inizio']."</td>";
                    echo "<td> ".$riga['ora_fine']."</td>";
                    $giorno_trovato= true;
                }
            }
            if( $giorno_trovato == false){
                echo "<td> --- </td>";
                echo "<td> --- </td>";
            }
        }
        $giorno_trovato= false;
        ?>
    </tr>
    <tr>
        <th scope="row"class="bg-secondary" >Domenica</th>
        <?php
        if( mysqli_num_rows( $tabella_orario) > 0){
            while ( $riga = $tabella_orario->fetch_assoc() ){
                if( $riga['giorno'] == 'Domenica'){
                    echo "<td> ".$riga['ora_inizio']."</td>";
                    echo "<td> ".$riga['ora_fine']."</td>";
                    $giorno_trovato= true;
                }
            }
            if( $giorno_trovato == false){
                echo "<td> --- </td>";
                echo "<td> --- </td>";
            }
        }
        $giorno_trovato= false;
        ?>
    </tr>

    </tbody>
</table>

</html>