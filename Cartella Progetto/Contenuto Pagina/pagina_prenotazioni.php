<?php session_start();//accedo alla variabile globale $_SESSION ?>
<!-- Fare in modo che una volta fatto il loghin la sessione resti aperta nelle altre pagine del sito! -->
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="../scss/main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>




</head>
<body>

<?php
if(!isset($_SESSION["id_utente"])){
    echo '
            <script>
                alert("Non Puoi accedere a questa pagina, devi essere loggato!!!");
                window.location.href = "../home.php";
            </script>
        ';
}
?>

<?php


echo '<div class="container containerAnimali">
            <p class="titolo">Pagina delle prenotazioni</p>
            <table class="table table-dark table-hover">
                <thead>
                <tr>
        <th>rimuovi</th>
        <th>id_prenotazioni</th>
        <th>nome utente</th>
        <th>giorno</th>
        <th>orario</th>
        <th>note</th>
                </tr>
                </thead>
                <tbody><form method="get" action ="paginaConfermaCanc.php">
                ';

$conn= new mysqli("localhost", "root", "", "db_progetto") or die("Connessione fallita: " . $conn->connect_error); //streammo l'errore di connessione;

$query_prenotazioni="SELECT *  FROM tabella_prenotazioni WHERE id_azienda =".$_SESSION["id_utente"]." or id_utente = ".$_SESSION["id_utente"];

$qris = $conn->query($query_prenotazioni);
if(mysqli_num_rows($qris) > 0){
    while($row = $qris->fetch_assoc()) {
        $query_id_utente="SELECT nome,cognome FROM utenti WHERE id_utente =".$row["id_utente"];
        $cont = $conn->query($query_id_utente);
        $ris = $cont->fetch_assoc();
        echo "<tr>
            <td><a href='paginaConfermaCanc.php?pren=".$row['id_prenotazione']."'>Rimuovi</a></td>
            <td>".$row["id_prenotazione"]."</td>
            <td>".$ris["nome"]."-".$ris["cognome"]."</td>
            <td>".$row["data"]."</td>
            <td>".$row["ora"]."</td>
            <td>".$row["note"]."</td>
        </tr>";


    }

    echo '</form> </tbody>
            </table>
        </div>
        ';
}else{
    echo '
            <script>
                alert("Non sono presenti prenotazioni");
                
            </script>
            ';
}
$conn->close();
?>

</body>
</html>
