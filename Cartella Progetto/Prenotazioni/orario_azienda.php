
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

        <?php
        if( mysqli_num_rows( $tabella_orario) > 0){
            while ( $riga = $tabella_orario->fetch_assoc() ){
                if( $riga['giorno'] == 'lunedi'){
                    if($riga['ora_inizio'] != "") {
                        echo '<tr><th scope="row" class="bg-secondary">Lunedi</th>';
                        echo "<td> " . $riga['ora_inizio'] . "</td>";
                        echo "<td> " . $riga['ora_fine'] . "</td></tr>";
                    }else{
                        echo '<tr><th scope="row" class="bg-secondary">Lunedi</th><td> --- </td>';
                        echo "<td> --- </td></tr>";
                    }
                }
                if( $riga['giorno'] == 'martedi'){
                    if($riga['ora_inizio'] != ""){
                        echo '<tr><th scope="row" class="bg-secondary">Martedi</th>';
                        echo "<td> ".$riga['ora_inizio']."</td>";
                        echo "<td> ".$riga['ora_fine']."</td></tr>";
                    }else{
                        echo '<tr><th scope="row" class="bg-secondary">Martedi</th>';
                        echo "<td> --- </td>";
                        echo "<td> --- </td></tr>";
                    }
                }
                if( $riga['giorno'] == 'mercoledi'){
                    if($riga['ora_inizio'] != ""){
                        echo '<tr><th scope="row" class="bg-secondary">Mercoledi</th>';
                        echo "<td> ".$riga['ora_inizio']."</td>";
                        echo "<td> ".$riga['ora_fine']."</td></tr>";
                    }else{
                        echo '<tr><th scope="row" class="bg-secondary">Mercoledi</th>';
                        echo "<td> --- </td>";
                        echo "<td> --- </td></tr>";
                    }
                }
                if( $riga['giorno'] == 'giovedi'){
                    if($riga['ora_inizio'] != ""){
                        echo '<tr><th scope="row" class="bg-secondary">giovedi</th>';
                        echo "<td> ".$riga['ora_inizio']."</td>";
                        echo "<td> ".$riga['ora_fine']."</td></tr>";
                    }else{
                        echo '<tr><th scope="row" class="bg-secondary">giovedi</th>';
                        echo "<td> --- </td>";
                        echo "<td> --- </td></tr>";
                    }
                }
                if( $riga['giorno'] == 'venerdi'){
                    if($riga['ora_inizio'] != ""){
                        echo '<tr><th scope="row" class="bg-secondary">venerdi</th>';
                        echo "<td> ".$riga['ora_inizio']."</td>";
                        echo "<td> ".$riga['ora_fine']."</td></tr>";
                    }else{
                        echo '<tr><th scope="row" class="bg-secondary">venerdi</th>';
                        echo "<td> --- </td>";
                        echo "<td> --- </td></tr>";
                    }
                }
                if( $riga['giorno'] == 'sabato'){
                    if($riga['ora_inizio'] != ""){
                        echo '<tr><th scope="row" class="bg-secondary">sabato</th>';
                        echo "<td> ".$riga['ora_inizio']."</td>";
                        echo "<td> ".$riga['ora_fine']."</td></tr>";
                    }else{
                        echo '<tr><th scope="row" class="bg-secondary">sabato</th>';
                        echo "<td> --- </td>";
                        echo "<td> --- </td></tr>";
                    }
                }
                if( $riga['giorno'] == 'domenica'){
                    if($riga['ora_inizio'] != ""){
                        echo '<tr><th scope="row" class="bg-secondary">domenica</th>';
                        echo "<td> ".$riga['ora_inizio']."</td>";
                        echo "<td> ".$riga['ora_fine']."</td></tr>";
                    }else{
                        echo '<tr><th scope="row" class="bg-secondary">domenica</th>';
                        echo "<td> --- </td>";
                        echo "<td> --- </td></tr>";
                    }
                }

            }

        }

        ?>

    </tbody>
</table>

</html>