<?php session_start() ?>
<html>
<head>
    <link rel="stylesheet" href="../scss/main.css">
</head>
<body>
<?php
if(isset($_SESSION["id_utente"])){
    if(isset($_GET["anim"])){
        $conn = new mysqli("localhost", "root", "", "db_progetto") or die("Errore accesso database ".$conn->error);
        if (isset($_POST["inserisci-preferito"])&&$_GET["mode"] == "inserisci"){

            $query_inserisci_preferito = "INSERT INTO Preferiti(animale, utente) VALUES ('" . $_GET['anim'] . "', '" . $_SESSION["id_utente"] . "');";
            $conn->query($query_inserisci_preferito) or die("Errore query di inserimento dell'animale in preferiti");
            $conn->close();
            echo '<script>
                alert("Inserimento tra i preferiti avvenuto con successo");
                window.location.href = "../home.php";
            </script>';
        }
        if(isset($_POST["rimuovi-preferito"])&&$_GET["mode"] == "rimuovi"){
            $query_rimuovi_preferito = "DELETE FROM Preferiti WHERE animale='" . $_GET['anim'] . "' and utente ='" . $_SESSION["id_utente"] . "';";
            $conn->query($query_rimuovi_preferito) or die("Errore query di rimozione dell'animale dai preferiti");
            $conn->close();
            echo '<script>
                alert("Rimosso dai preferiti avvenuto con successo");
                window.location.href = "../home.php";
            </script>';
        }
        if(isset($_POST["annulla"])){
            echo '<script>
                alert("Operazione annullata");
                window.location.href = "../home.php";
            </script>';
        }
    }else header('Location: ../home.php');
}else{
    echo '<script>
                alert("Non puoi inserire l animale tra i preferiti se non sei loggato");
                window.location.href = "../home.php";
            </script>';
}

?>

<form method="post" action =""><div class="pop-up-conferma">
            <?php
                if(isset($_GET["mode"])) {
                    if( $_GET["mode"] == "inserisci")echo '
                        <p>Sicuro di voler inserire l animale con <nobr>id= '.$_GET["anim"].' tra i preferiti?</nobr></p>
                        <p>
                        <button type="submit" name="inserisci-preferito" >InserisciPreferito</button>
                    ';
                    elseif($_GET["mode"] == "rimuovi") echo '
                        <p>Sicuro di voler rimuovere l animale con <nobr>id= '.$_GET["anim"].' dai preferiti?</nobr></p>
                        <p>
                        <button type="submit" name="rimuovi-preferito" >RimuoviPreferito</button>
                        
                    ';
                }

            ?>
            <button type="submit" name="annulla">Annulla</button></p>
    </div></form>
</body>
</html>


