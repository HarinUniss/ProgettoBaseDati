<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Animali per amici</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/main.css"> <!--linko il css della HP-->

    <!--Includo la libreria di jQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../script/registrazione.js"></script>
    <script>
        function checkDiConferma() {
            if (confirm("Sicuro di voler confermare la tua registrazione?")){
                <?php $conferma = 1;?>
            }
        }
    </script>
</head>
<body>
<?php
$id = $nome = $cognome = $telefono = $indirizzo = $civico = $citta = $email = $tipo = $userN = $pass = $foto = $rip_pass = "";
$nomeERR = $cognomeERR = $indirizzoERR = $civicoERR = $cittaERR = $telefonoERR = $emailERR = $usernERR = $passERR = $rip_passERR = $errori = "";
$conferma_successo = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //Per il caricamento immagine
    //NOn funziona per ora ahahah
    /*include_once('./caricamento_img.php');
    $foto = $_POST["fotoDaUpload"];*/

    if($conferma == 1){
        $tipo = $_POST["tipo"];
        //---Quà faccio dei controlli su elementi separati per tipo di utente---
        if ($tipo == "utente") {
            //controlli su cognome
            $cognome = htmlspecialchars($_REQUEST["cognome"]);
            if (empty($cognome)) {
                $cognomeERR = "*Valore non impostato";
            } else {
                $cognome = ucfirst(strtolower(ltrim($cognome))); //Mi elimina gli spazi "bianchi"(inutili) inseriti dall' utente
            }
        } else {
            if ($tipo == "canile" || $tipo == "allevamento") {
                //controllo su indirizzo
                $indirizzo = htmlspecialchars($_REQUEST["indirizzo"]); //Prendo l'indirizzo dato in input
                if (empty($indirizzo)) {
                    $indirizzoERR = "*Valore non impostato";
                } else {
                    $indirizzo = ltrim($indirizzo); //Mi elimina gli spazi "bianchi"(inutili) inseriti dall' utente
                    if (strpos($indirizzo, "via") == false) { //Dovrebbe controllarmi se c'è "via" nell' indirizzo inserito
                        $indirizzo = "via " . $indirizzo; //Se non è inserito lo inserisco io...
                    }
                }

                //il civico è impostato a tipo numerico, controllo solo se è stato inserito
                $civico = htmlspecialchars($_REQUEST["civico"]);
                if (empty($civico)) {
                    $civicoERR = "*Numero civico non inserito";
                }
            }
        }

        //---Qui ci sono i controlli per gli elementi utilizzabili da tutti i tipi di user---

        //Controlli su nome
        $nome = htmlspecialchars($_REQUEST["nome"]);
        if (empty($nome)) {
            $nomeERR = "*Valore non impostato";
        } else {
            $nome = ucfirst(strtolower(ltrim($nome))); //Mi elimina gli spazi "bianchi"(inutili) inseriti dall' utente
        }

        //Controlli su città
        $citta = htmlspecialchars($_REQUEST["citta"]);
        if (empty($citta)) {
            $cittaERR = "*Valore non impostato";
        } else {
            $citta = ucfirst(strtolower(ltrim($citta))); //Mi elimina gli spazi "bianchi"(inutili) inseriti dall' utente
        }

        //controllo telefono
        $telefono = htmlspecialchars($_REQUEST["telefono"]);
        if (empty($telefono)) {
            $telefonoERR = "*telefono non impostato";
            $telefono = "";
        }

        //Controllo email
        $email = strtolower(htmlspecialchars($_REQUEST["email"])); //Mi converte i caratteri in minuscolo...
        if (!empty($email)) {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailERR = "*email non valida";
                $email = "";
            }
        } else {
            $emailERR = "*email non inserita";
        }

        $userN = htmlspecialchars($_REQUEST['username']); //Assegnamento usarname;
        if (empty($userN)) {
            $usernERR = "username non inserito";
        }
        //I controlli sull' esistenza dell'username li faccio giù...

        $pass = htmlspecialchars($_REQUEST['password']);
        if (empty($pass)) {
            $passERR = "*password non inserita";
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
                $errori = "username già esistente";
            } else {
                $esiste = true;
                $id = rand(0, 9999999);

                if ($cognome == "") {
                    $cognome = null;
                }
                if ($civico == "") {
                    $civico = null;
                }
                if ($email == "") {
                    $email = null;
                }

                $query_reg_inUtente = "INSERT INTO utenti(id_utente, cognome, nome, indirizzo, civico, citta, telefono, email, foto, tipo)
        VALUES('$id', '$cognome', '$nome', '$indirizzo', '$civico', '$citta', '$telefono', '$email', null, '$tipo');";
                $query_reg_inCredenziali = "INSERT INTO credenziali(username, password, proprietario)
        VALUES('$userN', '$pass', '$id');";

                //Registro i dati nel database

                $conn->query($query_reg_inUtente) or die("Errore registrazione utente: " . $conn->error);

                $conn->query($query_reg_inCredenziali) or die("Errore registrazione credenziali: " . $conn->error);

                if (!$conn->connect_error) {
                    echo '<script type="text/javascript">';
                    echo 'alert("Registrazione avvenuta con successo");';
                    echo '</script>';
                }
            }

            $conn->close();

        } else {
            echo '<script type="text/javascript"> ';
            echo 'alert("Ops, Qualcosa è andato storto... Per favore, reinserisca le informazioni")';
            echo '</script>';
        }
    }
}?>
<div class="form-group">
    <p class="titolo">Benvenuto nella pagina di REGISTRAZIONE</p>
    <form method="post" action="">
        <label for="definizioneUser">Tipo di Utente:</label>
        <select class="form-control" id="definizioneUser" onchange="checkType(this.form)" name="tipo">
            <option class="f"></option>
            <option>utente</option>
            <option>canile</option>
            <option>allevamento</option>
        </select>
        <div id="div_nascondino"><br>
        <nobr><p class="titolo">Anagrafica</p>
        <input type="text" id="nome" placeholder="Nome" name="nome"><?php echo "<a class='error'>$nomeERR</a>"?><input type="text" id="cognome" placeholder="Cognome" name="cognome"><?php echo "<a class='error'>$cognomeERR</a>"?><br>
        <p class="indirizzo_civico">Indirizzo: <input type="text" id="indirizzo" placeholder="via indirizzo" name="indirizzo"><?php echo "<a class='error'>$indirizzoERR </a>"?> civico <input type="number" id="civico" placeholder="numero" name="civico"></p>
        Città: <input type="text" id="citta" name="citta"><?php echo "<a class='error'>$cittaERR</a>"?><br>
        Foto <input type="file" name="fotoDaUpload" id="FotoToUpload" name="foto"><br>
        </nobr><br>
        <nobr><p class="titolo">Contatti</p>
        Telefono: <input type="text" name="telefono" maxlength="10" placeholder="max-10 num"><?php echo "<a class='error'>$telefonoERR</a>"?>
        <p class="email">email: <input type="email" name="email"><?php echo "<a class='error'>$emailERR</a>"?></p></nobr>
        <hr style="background-color: #4a64e2;"><br>
            <div class="credenziali">
                <p class="titolo">Credenziali d'accesso</p>
                <nobr>Nome Utente: <input type="text" name="username"><?php echo "<a class='error'>$usernERR</a>"?></nobr> <nobr>Password: <input type="password" name="password"><?php echo "<a class='error'>$passERR</a>"?></nobr><br>
                Ripetere Password: <input type="password" name="rip_password"><?php echo "<a class='error'>$rip_passERR</a>"?><br><br>

                <!--<p class="conferma">Confermare? <input id="check_inserimento" type="checkbox">-->
                <button type="submit" class="btn btn-info" id="but_subm_registrazione" onclick="checkDiConferma()">Invia</button>
                </p>
            </div>
        </div>
    </form>
</div>
</body>
</html>

