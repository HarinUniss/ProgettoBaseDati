<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Animali per amici</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/main.css"> <!--linko il css della HP-->
    <link rel="stylesheet" href="../scss/main.css">

    <!--Includo la libreria di jQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../script/registrazione.js"></script>
</head>
<body>
<?php
$id = $nome = $cognome = $telefono = $indirizzo = $civico = $citta = $email = $tipo = $userN = $pass = $foto = $rip_pass = "";
$nomeERR = $cognomeERR = $indirizzoERR = $civicoERR = $cittaERR = $telefonoERR = $emailERR = $usernERR = $fotoERR= $passERR = $rip_passERR = $errori = "";


//Impostiamo la data e l'ora di roma...
date_default_timezone_set("Europe/Rome");

include_once('caricamento_img.php');
caricaIMG("Utente");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST["invia"])){
        if(isset($_SESSION["nome_immagine"])){
            //Controllo su immagine inserita da utente...
            $nomeImmagine = array_key_exists('nome_immagine', $_SESSION)?$_SESSION['nome_immagine'] : "";
            //Inserisco nel database la directory dove è presente la foto...
            if(file_exists($nomeImmagine)){ //Se il file esiste
                //Agiungo degli slash per la query Dovrebbero aiutare nel caso di qualche errore
                //Di inserimento della dir della foto
                $foto = addslashes ($nomeImmagine);
                unset($_SESSION['nome_immagine']); //unsetta la var sessione "nomeimmagine"
            }
        }

        //Non faccio alcun controllo perchè la pagina non carica se l'utente non sceglie il tipo...
        $tipo = $_POST["tipo"];
        //---Quà faccio dei controlli su elementi separati per tipo di utente---
        if ($tipo == "utente") {
            //controlli su cognome
            $cognome = htmlspecialchars($_REQUEST["cognome"]);
            if (empty($cognome)) {
                $cognomeERR = "*Valore non impostato";
            } else {
                //Mi lascia la prima lettera magliusc / mi mette tutte le altre min / mi toglie gli spazi bianchi (inutili)
                $cognome = ucfirst(strtolower(ltrim($cognome)));
            }
        } else {
            if ($tipo == "canile" || $tipo == "allevamento") {
                //controllo su indirizzo
                $indirizzo = htmlspecialchars($_REQUEST["indirizzo"]); //Prendo l'indirizzo dato in input
                if (empty($indirizzo)) {
                    $indirizzoERR = "*Valore non impostato";
                } else {
                    $indirizzo = ltrim($indirizzo); //Mi elimina gli spazi "bianchi"(inutili) inseriti dall' utente
                    if (!str_contains(strtolower($indirizzo), "via")) { //Dovrebbe controllarmi se c'è "via" nell' indirizzo inserito
                        $indirizzo = "via " . $indirizzo; //Se non è inserito lo inserisco io...
                    }
                }

                //il civico è impostato a tipo numerico, controllo solo se è stato inserito
                $civico = htmlspecialchars($_REQUEST["civico"]);
                if (empty($civico)) {
                    $civicoERR = "*Numero civico non inserito";
                }else{
                    if($civico < 0){
                        $civicoERR = "*Non può esistere un civico <0";
                    }
                }
            }
        }

        //---Qui ci sono i controlli per gli elementi utilizzabili da tutti i tipi di user---

        //Controlli su nome
        $nome = htmlspecialchars($_REQUEST["nome"]);
        if (empty($nome)) {
            $nomeERR = "*Nome non impostato";
        } else {
            //Mi lascia la prima lettera magliusc / mi mette tutte le altre min / mi toglie gli spazi bianchi (inutili)
            $nome = ucfirst(strtolower(ltrim($nome)));
        }

        //Controlli su città
        $citta = htmlspecialchars($_REQUEST["citta"]);
        if (empty($citta)) {
            $cittaERR = "*Citta non impostato";
        } else {
            //Mi lascia la prima lettera magliusc / mi mette tutte le altre min / mi toglie gli spazi bianchi (inutili)
            $citta = ucfirst(strtolower(ltrim($citta)));
        }

        //controllo telefono
        $telefono = htmlspecialchars($_REQUEST["telefono"]);
        if (empty($telefono)) {
            $telefonoERR = "*telefono non impostato";
            $telefono = "";
        }else{
            if(strlen($telefono)!=10){
                $telefonoERR = "*lunghezza del numero di telefono diversa da 10";
            }
        }

        //Controllo email
        $email = strtolower(htmlspecialchars($_REQUEST["email"])); //Mi converte i caratteri in minuscolo...
        if (!empty($email)) {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                //Controlla l'email filtrando la stringa in cerca di caratteri e pattern validi
                //Negato...
                $emailERR = "*email non valida";
                $email = "";
            }
        } else {
            $emailERR = "*email non inserita";
        }

        $userN = htmlspecialchars($_REQUEST['username']); //Assegnamento usarname;
        if (empty($userN)) {
            $usernERR = "*username non inserito<br>";
            //I controlli sull' esistenza dell'username li faccio giù, all'accesso
            //del database...
        }


        $pass = htmlspecialchars($_REQUEST['password']);
        if (empty($pass)) {
            $passERR = "*password non inserita";
        }else{
            if(strlen($pass) < 8){
                $passERR = $passERR."*inserire una password di almeno 8 caratteri";
            }
            if(preg_match("/[\[^\'£$%^&*()}{@:\'#~?><>,;@\|=-\\\\-_+\-¬\`\]]/", $pass)<1){
                $passERR = $passERR."*inserire almeno un carattere speciale";
            }
        }
        $rip_pass = htmlspecialchars($_REQUEST['rip_password']);
        if (empty($rip_pass)) {
            $rip_passERR = "*sezione lasciata vuota";
        } else {
            if (strcmp($rip_pass, $pass) != 0) {  //Se != 0 sono diverse
                $passERR = $rip_passERR = "*Password non coincidenti";
                $rip_pass = "";
            } else {
                $pass = sha1(md5(sha1($pass)));
                $rip_pass = sha1(md5(sha1($rip_pass)));
            }
        }

        $errori = $nomeERR . $cognomeERR . $indirizzoERR . $cittaERR . $telefonoERR . $emailERR . $usernERR . $passERR;
        if ($errori == "") {

            //crea connessione
            $conn = new mysqli("localhost", "root", "", "db_progetto") or die("Connessione fallita: " . $conn->connect_error); //streammo l'errore di connessione;

            //Query di controllo se esiste già l'username
            $sql_check_user = "SELECT *
                        FROM credenziali as C
                        WHERE C.username = '$userN'";
            $risultato = $conn->query($sql_check_user) or die("Query di controllo username errata");
            $num = mysqli_num_rows($risultato);
            if ($num > 0) {
                $errori = "*username già esistente<br>";
            } else {

                $dataora_registrazione = date("Y-m-d h:i:sa");


                $query_registra_utente = "CALL CreaUtente('$cognome', '$nome', '$indirizzo', '$civico', '$citta', '$telefono', '$email', '$foto', '$tipo', '$dataora_registrazione', '$userN', '$pass')";
                $conn->query($query_registra_utente) or die("Errore registrazione utente: " . $conn->error);

                echo '<script type="text/javascript"> 
                    alert("Registrazione avvenuta con successo :)");
                    window.location.href = "login.php?reg=ok";
                    </script>';
            }

            $conn->close();


        } else {
            echo '<script type="text/javascript"> ';
            echo 'alert("Ops, Qualcosa è andato storto :( Per favore, reinserisca i dati")';
            echo '</script>';
        }
    }

}

?>
<div class="form-group">
    <p class="titolo">Benvenuto nella pagina di REGISTRAZIONE</p>
    <!--enctype indica che i file che trasferiamo sono di tipo diverso del testo-->
    <form method="post" action="" enctype="multipart/form-data">
        <div class="pop-up-conferma">
            <p><nobr>Sicuro di voler confermare?</nobr></p>
            <p>
                <button type="submit" name="invia" class="btn btn-danger" id="invia_reg">conferma</button><button type="button" name="cancella" class="btn btn-secondary" id="annulla_reg">annulla</button>
            </p>
        </div>
        <?php  echo "Inizio sessione di registrazione: ".date("d-m-Y h:i:sa")."<br>";?>
        <label for="definizioneUser"><p class="titolo">Tipo di Utente:</p></label>
        <select class="form-control" id="definizioneUser" onchange="checkType(this.form)" name="tipo">
            <option class="f"></option>
            <option>utente</option>
            <option>canile</option>
            <option>allevamento</option>
        </select>
        <div id="div_nascondino"><br>
            <p class="suggerimento_inserimento">Dimensione immagine max: 5MByte</p>
            Foto <input type="file" name="img" id="FotoToUpload" ><br>
            <?php echo "<a class='error'>$fotoERR</a>";?>
            <nobr><p class="titolo">Anagrafica</p>
            <input type="text" id="nome" placeholder="Nome" name="nome"><?php echo "<a class='error'>$nomeERR</a>"?><p id="cognome"><input type="text" placeholder="Cognome" name="cognome"><?php echo "<a class='error'>$cognomeERR</a>"?></p>
            <p class="indirizzo_civico">Indirizzo: <input type="text" id="indirizzo" placeholder="via indirizzo" name="indirizzo"><?php echo "<a class='error'>$indirizzoERR </a>"?> <br>civico <input type="number" id="civico" placeholder="numero" name="civico"></p>
            Città: <input type="text" id="citta" name="citta"><?php echo "<a class='error'>$cittaERR</a>"?>

            </nobr><br>
            <p class="titolo">Contatti</p>
            <p class="suggerimento_inserimento">Inserire max 10 numeri...</p>
            <nobr>Telefono: <input type="number" name="telefono" maxlength="10" placeholder="max-10 num"><?php echo "<a class='error'>$telefonoERR</a>"?>
            <p class="email">email: <input type="email" name="email"><?php echo "<a class='error'>$emailERR</a>"?></p></nobr>
            <hr style="background-color: #4a64e2;"><br>
                <div class="credenziali">
                    <p class="titolo">Credenziali d'accesso</p>
                    <p class="suggerimento_inserimento">Per la password, inserire minimo 8 caratteri ed almeno un carattere speciale </p>
                    <nobr>Nome Utente: <input type="text" name="username"><?php echo "<a class='error'>$usernERR</a>"?></nobr> <nobr>Password: <input type="password" name="password" placeholder="inserire min 8 caratteri"><?php echo "<a class='error'>$passERR</a>"?></nobr><br>
                    Ripetere Password: <input type="password" name="rip_password"><?php echo "<a class='error'>$rip_passERR</a>"?><br><br>

                    <p class="conferma"><!--Confermare? <input id="check_inserimento" name="check_inserimento" type="checkbox">-->
                        <button type="button" name="button_invia" class="btn btn-warning" id="but_active_pop_up_conferma">Invia</button>
                    </p>
                </div>
        </div>
    </form>
</div>
</body>
</html>

