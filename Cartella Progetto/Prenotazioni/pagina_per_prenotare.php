<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../scss/main.css">
    <script src="../script/pagina_per_prenotare.js"></script>
<script>
    function getOrario(data){
        var xml = new XMLHttpRequest();
        xml.onreadystatechange = function(){
            document.getElementById("ora_disp").innerHTML = this.responseText;
        };
        var azienda = <?php echo $_GET["azienda"]; ?>;
        xml.open("GET", "getOrario.php?giorno="+data+"&azienda="+ azienda, true);
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
    $data = $nota = "";
    if(isset($_POST["invia_prenotazione"]))
        if(isset($_POST["data"])){
            /*echo date("d-m-Y h:i:sa");*/

            //echo date('l, j F Y', $timestamp); // stamperà Thursday, 15 December 2016

            $giorno = date('l', strtotime($_POST["data"]));


            if(date('j', strtotime($_POST["data"]))>=date("d") &&
                date('F', strtotime($_POST["data"]))>=date("m") &&
                date('Y', strtotime($_POST["data"]))>=date("Y")) {
                $data = $_POST["data"];

            }
            /*else{
                $errore = "Errore Inserimento data, dev'essere < 10 giorni da oggi";
            }*/
            if(isset($_POST["ora_disp"])){
                if($data != ""){
                    $conn = new mysqli("localhost", "root", "", "db_progetto") or die("Errore di connessione: " . $conn->connect_error);
                    $ora_scelta = $_POST["ora_disp"];
                    if(isset($_POST["nota"]))
                        $nota = $_POST["nota"];
                    $query_crea_prenotazione = "CALL CreaPrenotazione('".$_SESSION['id_utente']."', '".$_GET["azienda"]."', '".$data."', '".$ora_scelta."', '".$nota."')";
                    $ris = $conn->query($query_crea_prenotazione) or die("Errore query prenotazione");
                    echo '
                        <script>
                            alert("Prenotazione avvenuta con successo");
                            window.location.href = "../home.php";
                        </script>
                        ';
                }else{
                    echo '
                        <script>
                            alert("Errore nell inserimento della data");
                        </script>
                        ';
                }


            }else{
                echo '
                        <script>
                            alert("Non è stata inserita l ora desiderata");
                        </script>
                        ';
            }
        }else{
            echo '
                        <script>
                            alert("Non è stata inserita una data valdida");
                        </script>
                        ';
        }



    ?>
    <nobr><p>Pagina di prenotazione per <?php echo "<p id='numero_azienda'>".$_GET["azienda"]."</p>" ?></p></nobr>

    <form method="post">
        <div class="pop-up-conferma">
            <p><nobr>Sicuro di voler confermare?</nobr></p>
            <p>
                <button type="submit" name="invia_prenotazione" class="btn btn-danger" id="invia_reg">conferma</button><button type="button" class="btn btn-secondary annulla">annulla</button>
            </p>
        </div>
        <input type="date" name ="data" oninput="getOrario(this.value)">

        <label for="ora_disp">Ora</label>
        <select name="ora_disp" id="ora_disp">

        </select><br>
        <input type="text" name ="nota" class="nota" placeholder="Inserisci una nota">
        <button type="button"></button>
        <button type="button" class="invia">Premi</button>
    </form>
</body>
</html>
<?php

//una sezione che mostra gli orari di lavoro del canile

//una sezione con dei bottoni che mostrano gli orari prenotabili

//sezione che prenota e conferma prenotazione

?>

