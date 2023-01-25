<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
function getOrario(data){
    var azienda = document.getElementById("numero_azienda").value;
    var xml = new XMLHttpRequest();
    xml.onreadystatechange = function(){
        document.getElementById("ora_disp").innerHTML = this.responseText;
    };
    xml.open("GET", "getOrario.php?giorno="+data+"&azienda="+azienda, true);
    xml.send();
}
</script>
</head>
<body>
    <?php
        if(!isset($_SESSION["id_utente"])){
            header("location: ../home.php");
        }
    ?>
    <?php
       //$conn = new mysqli("localhost", "root", "", "db_progetto") or die("Errore di connessione: " . $conn->connect_error);

        if(isset($_POST["invia_prenotazione"]))
            if(isset($_POST["data"])){
                echo date("d-m-Y h:i:sa");

                //echo date('l, j F Y', $timestamp); // stamperà Thursday, 15 December 2016
                $giorno = date('l', strtotime($_POST["data"]));

                if(date('j', strtotime($_POST["data"]))>=date("d") &&
                    date('F', strtotime($_POST["data"]))>=date("m") &&
                    date('Y', strtotime($_POST["data"]))>=date("Y")) {
                    echo "Yeahh";

                }
                if(isset($_POST["ora_disp"])){
                    $ora_scelta = $_POST["ora_disp"];

                }
            }



    ?>
    <p>Pagina di prenotazione per <?php echo "<p id='numero_azienda'>".$_GET["azienda"]."</p>" ?></p>


    <form method="post">
        <input type="date" name ="data" oninput="getOrario(this.value)">

        <label for="ora_disp">Ora</label>
        <select name="ora_disp" id="ora_disp">

        </select><br>


        <button type="submit" name="invia_prenotazione">Premi</button>
    </form>
</body>
</html>
<?php

//una sezione che mostra gli orari di lavoro del canile

//una sezione con dei bottoni che mostrano gli orari prenotabili

//sezione che prenota e conferma prenotazione

?>

