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
        $query_delete_animale = "DELETE FROM Animali WHERE id_animale = '".$_GET['anim']."';";
        $conn->query($query_delete_animale) or die("Errore query di eliminazione dell'animale");
        $conn->close();
        echo '<script>
                alert("Eliminazione animale avvenuta con successo");
                window.location.href = "paginaAnimaliInseriti.php";
            </script>';
        unset($_GET["anim"]);
    }elseif(isset($_POST["annulla-cancella"])){
        unset($_GET["anim"]);
        echo '<script>
                alert("Eliminazione animale Annullata");
                window.location.href = "paginaAnimaliInseriti.php";
            </script>';
    }

}
?>
<form method="post" action =""><div class="pop-up-conferma">
        <p>Sicuro di voler elimiare l animale con id= <?php echo $_GET["anim"] ?>?</p>
        <p><button type="submit" id="invia_reg" name="rimuovi-animale" class="btn btn-danger">Rimuovi</button>
            <button type="button" id="annulla_reg" name="annulla-cancella">Annulla</button></p>
    </div></form>

</body>
</html>
