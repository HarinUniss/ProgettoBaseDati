<?php session_start();//accedo alla variabile globale $_SESSION ?>
<!-- Fare in modo che una volta fatto il loghin la sessione resti aperta nelle altre pagine del sito! -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>


<div>
    <table class="table table-dark table-hover">
        <thead>
        <tr>
            <th>id_prenotazioni</th>
            <th>nome utente</th>
            <th>giorno</th>
            <th>orario</th>
            <th>id_prenotazioni</th>

        </tr>
        </thead>
        <tbody><form method="get" action ="paginaConfermaCanc.php">
    <?php
    $conn= new mysqli("localhost", "root", "", "db_progetto") or die("Connessione fallita: " . $conn->connect_error); //streammo l'errore di connessione;

    $query_prenotazioni="SELECT *  FROM tabella_prenotazioni WHERE id_azienda =".$_SESSION["id_utente"];

    $qris = $conn->query($query_prenotazioni);
    while($row = $qris->fetch_assoc()) {



            }
    ?>
</body>
</html>
