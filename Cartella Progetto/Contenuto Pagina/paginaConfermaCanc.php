<html>
<head>
    <link rel="stylesheet" href="../scss/main.css">
</head>
<body>
<?php
if(!isset($_GET["anim"])){
    header('Location: ../home.php');
}else{
    if(isset($_POST["rimuovi-animale"])){
        $conn = new mysqli("localhost", "root", "", "db_progetto") or die("Errore accesso database ".$conn->error);

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
    }elseif(isset($_POST["annulla"])){
        unset($_GET["anim"]);
        echo '<script>
                alert("Eliminazione animale Annullata");
                window.location.href = "paginaAnimaliInseriti.php";
            </script>';
    }


}

?>
<form method="post" action =""><div class="pop-up-conferma">
        <p>Sicuro di voler inserire l' animale con <nobr>id= <?php echo $_GET["anim"] ?> tra i preferiti?</nobr></p>
        <p><button type="submit" name="rimuovi-animale" >Rimuovi</button>
            <button type="submit" name="annulla">Annulla</button></p>
    </div></form>

</body>
</html>
