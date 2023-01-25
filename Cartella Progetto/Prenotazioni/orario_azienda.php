
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
$giornoSettimana = [
    "Alunedi" => "---",
    "Clunedi" => "---",
    "Amartedi" => "---",
    "Cmartedi" => "---",
    "Amercoledi" => "---",
    "Cmercoledi" => "---",
    "Agiovedi" => "---",
    "Cgiovedi" => "---",
    "Avenerdi" => "---",
    "Cvenerdi" => "---",
    "Asabato" => "---",
    "Csabato" => "---",
    "Adomenica" => "---",
    "Cdomenica" => "---"
];


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
        while ( $riga = $tabella_orario->fetch_assoc()){
            if( $riga['giorno'] == 'lunedi'){
                    $giornoSettimana["Alunedi"] = $riga['ora_inizio'];
                    $giornoSettimana["Clunedi"] = $riga['ora_fine'];
            }
            if( $riga['giorno'] == 'martedi'){
                $giornoSettimana["Amartedi"] = $riga['ora_inizio'];
                $giornoSettimana["Cmartedi"] = $riga['ora_fine'];
            }
            if( $riga['giorno'] == 'mercoledi'){
                $giornoSettimana["Amercoledi"] = $riga['ora_inizio'];
                $giornoSettimana["Cmercoledi"] = $riga['ora_fine'];
            }
            if( $riga['giorno'] == 'giovedi'){
                $giornoSettimana["Agiovedi"] = $riga['ora_inizio'];
                $giornoSettimana["Cgiovedi"] = $riga['ora_fine'];
            }
            if( $riga['giorno'] == 'venerdi'){
                $giornoSettimana["Avenerdi"] = $riga['ora_inizio'];
                $giornoSettimana["Cvenerdi"] = $riga['ora_fine'];
            }
            if( $riga['giorno'] == 'sabato'){
                $giornoSettimana["Asabato"] = $riga['ora_inizio'];
                $giornoSettimana["Csabato"] = $riga['ora_fine'];
            }
            if( $riga['giorno'] == 'domenica'){
                $giornoSettimana["Adomenica"] = $riga['ora_inizio'];
                $giornoSettimana["Cdomenica"] = $riga['ora_fine'];
            }

        }

    }

    ?>
    <tr><th scope="row" class="bg-secondary">Lunedi</th>
        <?php
            echo '<td>'.$giornoSettimana["Alunedi"].'</td>';
            echo '<td>'.$giornoSettimana["Clunedi"].'</td>';
        ?>
    </tr>

    <tr><th scope="row" class="bg-secondary">Martedi</th>
        <?php
        echo '<td>'.$giornoSettimana["Amartedi"].'</td>';
        echo '<td>'.$giornoSettimana["Cmartedi"].'</td>';
        ?>
    </tr>

    <tr><th scope="row" class="bg-secondary">Mercoledi</th>
        <?php
        echo '<td>'.$giornoSettimana["Amercoledi"].'</td>';
        echo '<td>'.$giornoSettimana["Cmercoledi"].'</td>';
        ?>
    </tr>

    <tr><th scope="row" class="bg-secondary">giovedi</th>
        <?php
        echo '<td>'.$giornoSettimana["Agiovedi"].'</td>';
        echo '<td>'.$giornoSettimana["Cgiovedi"].'</td>';
        ?>
    </tr>

    <tr><th scope="row" class="bg-secondary">venerdi</th>
        <?php
        echo '<td>'.$giornoSettimana["Avenerdi"].'</td>';
        echo '<td>'.$giornoSettimana["Cvenerdi"].'</td>';
        ?>
    </tr>

    <tr><th scope="row" class="bg-secondary">sabato</th>
        <?php
        echo '<td>'.$giornoSettimana["Asabato"].'</td>';
        echo '<td>'.$giornoSettimana["Csabato"].'</td>';
        ?>
    </tr>

    <tr><th scope="row" class="bg-secondary">domenica</th>
        <?php
        echo '<td>'.$giornoSettimana["Adomenica"].'</td>';
        echo '<td>'.$giornoSettimana["Cdomenica"].'</td>';
        ?>
    </tr>

    </tbody>
</table>

</html>