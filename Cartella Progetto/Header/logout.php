<?php session_start();
if (isset($_GET["logout"])){ //Se la richiesta arriva dal form di logout esegue questo
    session_unset(); //Rimuove ogni variabile di sessione create
    session_destroy(); //Distrugge la sessione
    echo '<script type="text/javascript">alert("logout effettuato, arrivederci");
                window.location.href = "../home.php";
            </script>';
}
?>
