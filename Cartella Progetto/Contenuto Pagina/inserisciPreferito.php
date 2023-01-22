<?php session_start() ?>
<html>
<head>
    <link rel="stylesheet" href="../scss/main.css">
</head>
<body>
<?php
if(isset($_SESSION["id_utente"])){
    if(isset($_GET["anim"])) {
        if (isset($_POST["inserisci-preferito"])){
            $conn = new mysqli("localhost", "root", "", "db_progetto") or die("Errore accesso database ".$conn->error);
            $query_inserisci_preferito = "INSERT INTO Preferiti(animale, utente) VALUES ('" . $_GET['anim'] . "', '" . $_SESSION["id_utente"] . "');";
            $conn->query($query_inserisci_preferito) or die("Errore query di inserimento dell'animale in preferiti");
            $conn->close();
            echo '<script>
                alert("Inserimento tra i preferiti avvenuto con successo");
                window.location.href = "../home.php";
            </script>';
        }

    }else{
        header('Location: ../home.php');
    }
}else{
    echo '<script>
                alert("Non puoi inserire l animale tra i preferiti se non sei loggato");
                window.location.href = "../home.php";
            </script>';
}

?>

<form method="post" action =""><div class="pop-up-conferma">
        <p>Sicuro di voler inserire l' animale con <nobr>id= <?php echo $_GET["anim"] ?> tra i preferiti?</nobr></p>
        <p><button type="submit" name="inserisci-preferito" >InserisciPreferito</button>
            <button type="submit" name="annulla">Annulla</button></p>
    </div></form>
</body>
</html>