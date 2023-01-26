<html>
<head>
    <link rel="stylesheet" href="../scss/main.css">
</head>
<body>
<?php
if(!isset($_GET["anim"]) && !isset($_GET["pren"])){
    header('Location: ../home.php');
}else{
    if(isset($_POST["rimuovi"])){
        $conn = new mysqli("localhost", "root", "", "db_progetto") or die("Errore accesso database ".$conn->error);

        if(isset($_GET["anim"])){
            $query_foto_animale="SELECT foto FROM Animali WHERE id_animale = '".$_GET['anim']."';";         //query per la foto animale
            $foto_animale=$conn->query($query_foto_animale) or die("Errore query Foto Animale");            //eseguo la queri per la foto animale

            $query_delete_animale = "CALL EliminaAnimale('".$_GET['anim']."');";                       //query per eliminare l'animale
            $conn->query($query_delete_animale) or die("Errore query di eliminazione dell'animale");   //esegue la procedura sql per eliminare l'animale

            while ($row = $foto_animale->fetch_assoc()) {
                unlink($row["foto"]);                                                                   //elimmina la foto dell'animale eliminato
            }
            $conn->close();
            echo '<script>
                alert("Eliminazione animale avvenuta con successo");
                window.location.href = "paginaAnimaliInseriti.php";
            </script>';
            unset($_GET["anim"]);
        }
        if(isset($_GET["pren"])){
            $query_delete_pren ="CALL EliminaPrenotazioni('".$_GET['pren']."')";
            $conn->query($query_delete_pren) or die("Errore query di eliminazione prenotazione");
            echo '<script>
                alert("Eliminazione Prenotazione avvenuta con successo");
                window.location.href = "../home.php";
            </script>';
            unset($_GET["pren"]);
        }



    }elseif(isset($_POST["annulla"])&&isset($_GET["anim"])){
        unset($_GET["anim"]);
        echo '<script>
                alert("Eliminazione animale Annullata");
                window.location.href = "paginaAnimaliInseriti.php";
            </script>';
    }elseif(isset($_POST["annulla"])&&isset($_GET["pren"])){
        unset($_GET["pren"]);
        echo '<script>
                alert("Eliminazione Prenotazione Annullata");
                window.location.href = "../home.php";
            </script>';
    }



}

?>
<form method="post" action =""><div class="pop-up-conferma">
        <?php
            if(isset($_GET["anim"])){
                echo '<p>Sicuro di voler Eliminare l animale con <nobr>id=  '.$_GET["anim"].'</nobr></p>';
            }elseif(isset($_GET["pren"])){
                echo '<p>Sicuro di voler Eliminare la prenotazione con <nobr>id=  '.$_GET["pren"].'</nobr></p>';
            }
        ?>
        <p><button type="submit" name="rimuovi" >Rimuovi</button>
            <button type="submit" name="annulla">Annulla</button></p>
    </div></form>

</body>
</html>
