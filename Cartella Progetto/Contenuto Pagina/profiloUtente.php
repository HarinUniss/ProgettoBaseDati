<?php session_start();?>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
    <link rel="stylesheet" href="../scss/main.css">
    <script src="../script/profiloUtente.js"></script>
    <script src="../script/header.js"></script>
    <style>
        img{
            max-width: 300px;
            max-height: 300px;
        }
    </style>
</head>
<body>
<?php

//Variabili che prendono le modifiche
$modifica_nome = $modifica_cognome = $modifica_telefono = $modifica_indirizzo = $modifica_civico = $modifica_citta = $modifica_email = $campiModificati = "";
//Variabili dell'utente proprietario della pagina
$foto = $nome = $cognome = $telefono = $indirizzo = $civico = $citta = $tipo = $email = $dataora = "";
//Variabili che prenderanno gli errori
$telefonoERR = $emailERR ="";

$id_utente = "";


    //Sezione che si occupa di gestire in base all'utente che accede a questa pagina
    //la visualizzazione dei vari campi
    if(isset($_GET["user"])){
        //Se l'utente è diverso da quello loggato, allora sto entrando in una pagina
        //Di un altro utente che voglio visualizzare

        //Devo fare così altriementi se un utente non loggato entra qui si generano dei warning
        //E devo passarlo tramite variabile senno non funziona... Nonn sò perchè
        $x = array_key_exists("id_utente", $_SESSION)? $_SESSION["id_utente"] : "";
        if($_GET["user"] != $x){
            $id_utente = $_GET["user"]; //id proprietario pagina
            //Caricamento informazioni utente
            $conn = new mysqli("localhost", "root", "", "db_progetto") or
            die("Non è possibile accedere alle informazioni dell'utente");
            if(!$conn->connect_error){
                $ris = $conn->query("SELECT * FROM Utenti WHERE id_utente = '".$id_utente."'")or die("Errore query loading info utente");
                if(mysqli_num_rows($ris) == 1){
                    $row = $ris->fetch_assoc();
                    $foto = $row["foto"];
                    $tipo = $row["tipo"];
                    $nome = $row["nome"];
                    $cognome = $row["cognome"];
                    $indirizzo = $row["indirizzo"];
                    $civico = $row["civico"];
                    $citta = $row["citta"];
                    $email = $row["email"];
                    $telefono = $row["telefono"];
                    $dataora = $row["dataora"];
                }
            }

        }else {
            //Altrimenti è la mia pagina del profilo e quindi posso abilitare le modifiche
            //E salvo tutte le informazioni senza entrare nel database
            $foto = $_SESSION["foto"];
            $id_utente = $_SESSION["id_utente"]; //id_utente loggato
            $tipo = $_SESSION["tipo"];
            $nome = $_SESSION["nome_utente"];
            if(isset($_SESSION["cognome_utente"]))
                $cognome = $_SESSION["cognome_utente"];
                    $telefono = $_SESSION["telefono"];
            if(isset($_SESSION["indirizzo"]) && isset($_SESSION["civico"])){
                $indirizzo = $_SESSION["indirizzo"];
                $civico = $_SESSION["civico"];
            }
            $citta = $_SESSION["citta"];
            $email = $_SESSION["email"];
            $dataora = $_SESSION["dataora"];
        }
    }

// ---------------------INIZIO A PRENDERE I DATI PER LA MODIFICA --------------------------------

    if($_SERVER["REQUEST_METHOD"] == "POST" ){
        if(isset($_POST["invia"]) && $id_utente === $_SESSION["id_utente"]){

            $modifica_nome = htmlspecialchars($_REQUEST["nome"]);
            if($modifica_nome != ""){

                //Mi lascia la prima lettera magliusc / mi mette tutte le altre min / mi toglie gli spazi bianchi (inutili)
                $modifica_nome = ucfirst(strtolower(ltrim($modifica_nome))); //Mi elimina gli spazi "bianchi"(inutili) inseriti dall' utente
            }

            //Faccio un controllo speciale per utente per il cognome
            if($tipo === "utente"){
                $modifica_cognome = htmlspecialchars($_REQUEST["cognome"]);
                if($modifica_cognome != ""){
                    //Mi lascia la prima lettera magliusc / mi mette tutte le altre min / mi toglie gli spazi bianchi (inutili)
                    $modifica_cognome = ucfirst(strtolower(ltrim($modifica_cognome))); //Mi elimina gli spazi "bianchi"(inutili) inseriti dall' utente
                }
            }

            //Faccio un controllo speciale in indirizzo e civico per utenti di tipo canile e allevamento
            if ($tipo === "canile" || $tipo === "allevamento") {
                //controllo su indirizzo
                $modifica_indirizzo = htmlspecialchars($_REQUEST["indirizzo"]); //Prendo l'indirizzo dato in input
                if($modifica_indirizzo != ""){
                    $modifica_indirizzo = ltrim($modifica_indirizzo); //Mi elimina gli spazi "bianchi"(inutili) inseriti dall' utente
                    if (!str_contains(strtolower($modifica_indirizzo), "via")) { //Dovrebbe controllarmi se c'è "via" nell' indirizzo inserito
                        $modifica_indirizzo = "via " . $modifica_indirizzo; //Se non è inserito lo inserisco io...
                    }
                }

                //il civico è impostato a tipo numerico, controllo solo se è stato inserito
                $modifica_civico = htmlspecialchars($_REQUEST["civico"]);
                if (empty($modifica_civico)) {
                    $civicoERR = "*Numero civico non inserito";
                }
            }

            //Controllo Citta
            $modifica_citta = htmlspecialchars($_REQUEST["citta"]);
            if($modifica_citta != ""){
                $modifica_citta = ucfirst(strtolower(ltrim($modifica_citta))); //Mi elimina gli spazi "bianchi"(inutili) inseriti dall' utente
            }

            //Controllo il numero di telefono
            $modifica_telefono = htmlspecialchars($_REQUEST["telefono"]);
            //Il numero di telefono deve contenere 10 cifre, quindi se inserito da utente
            //Controllo il numero di cifre
            if($modifica_telefono != "" && strlen($modifica_telefono) != 10){
                $telefonoERR = "*Inserire un numeero di telefono da 10 cifre";
            }

            //Controllo email
            $modifica_email = strtolower(htmlspecialchars($_REQUEST["email"])); //Mi converte i caratteri in minuscolo...
            if (!empty($modifica_email)) {
                if (!filter_var($modifica_email, FILTER_VALIDATE_EMAIL)) {
                    //Controlla l'email filtrando la stringa in cerca di caratteri e pattern validi
                    //Negato...
                    $emailERR = "*email non valida";
                    $modifica_email = "";
                }
            }


//----------------------INSERISCO LE MODIFICHE NEL DATABASE -------------------------------------------

            //Concateno gli errori e controllo se ci sono
            if($emailERR.$telefonoERR == ""){
                //Connessione database
                $conn = new mysqli("localhost", "root", "", "db_progetto") or die("Impossibile connettersi al database");
                if(!$conn->connect_error){
                    if($modifica_nome != "" && $modifica_nome != $_SESSION["nome_utente"]){
                        $conn->query('update Utenti set nome = "'.$modifica_nome.'" where id_utente = '.$id_utente.';')
                        or die("Errore nella query di modifica nome Utente");
                        $campiModificati = $campiModificati." nome";
                        $_SESSION["nome"] = $modifica_nome;
                    }
                    if($modifica_cognome != "" && $modifica_cognome != $_SESSION["cognome_utente"]){
                        $conn->query('update Utenti set cognome = "'.$modifica_cognome.'" where id_utente = '.$id_utente.';')
                        or die("Errore nella query di modifica cognome Utente");
                        $campiModificati = $campiModificati." cognome";
                        $_SESSION["cognome_utente"] = $modifica_cognome;
                    }
                    if($modifica_indirizzo != "" && $modifica_indirizzo != $_SESSION["indirizzo"]){
                        $conn->query('update Utenti set indirizzo = "'.$modifica_indirizzo.'" where id_utente = '.$id_utente.';')
                        or die("Errore nella query di modifica indirizzo Utente");
                        $campiModificati = $campiModificati." indirizzo";
                        $_SESSION["indirizzo"] = $modifica_indirizzo;
                    }
                    if($modifica_civico != "" && $modifica_civico != $_SESSION["civico"]){
                        $conn->query('update Utenti set civico = "'.$modifica_civico.'" where id_utente = '.$id_utente.';')
                        or die("Errore nella query di modifica Civico Utente");
                        $campiModificati = $campiModificati." civico";
                        $_SESSION["civico"] = $modifica_civico;
                    }
                    if($modifica_telefono != "" && $modifica_telefono != $_SESSION["telefono"]){
                        $conn->query('update Utenti set telefono = "'.$modifica_telefono.'" where id_utente = '.$id_utente.';')
                        or die("Errore nella query di modifica telefono Utente");
                        $campiModificati = $campiModificati." telefono";
                        $_SESSION["telefono"] = $modifica_telefono;
                    }
                    if($modifica_citta != "" && $modifica_citta != $_SESSION["citta"]){
                        $conn->query('update Utenti set citta = "'.$modifica_citta.'" where id_utente = '.$id_utente.';')
                        or die("Errore nella query di modifica citta Utente");
                        $campiModificati = $campiModificati." citta";
                        $_SESSION["citta"] = $modifica_citta;
                    }
                    if($modifica_email != "" && $modifica_email != $_SESSION["email"]){
                        $conn->query('update Utenti set email = "'.$modifica_email.'" where id_utente = '.$id_utente.';')
                        or die("Errore nella query di modifica email Utente");
                        $campiModificati = $campiModificati." email";
                        $_SESSION["email"] = $modifica_email;
                    }
                    $conn->close(); //Chiudo la connessione al db
                }

                if($campiModificati != ""){
                    session_unset();
                    session_destroy();
                    echo '<script>
                        alert("Sono stati modificati i campi: '.$campiModificati.', Consiglio di riloggare Per vedere le modifiche");
                        window.location.href = "login.php";
                        </script>';
                }else{
                    echo '<script>alert("Non sono state riscontrate modifiche")</script>';
                }
            }else{
                echo '<script>alert("Nei campi che hai inserito per essere modificati, sono stati riscontrati errori")</script>';
            }

        }elseif($id_utente != $_SESSION["id_utente"]){
            echo '<script>
            alert("Non puoi modificare le cose che non ti appartengono :/");
            </script>';

        }elseif(isset($_POST["elimina_profilo"])){//Da testare l'eliminazione del profilo
            $conn = new mysqli("localhost", "root", "", "db_progetto") or die("Impossibile connettersi al database");
            $conn->query("DELETE from Utenti where Utenti.id_utente = '$id_utente';") or die("Non è stato possibile cancellare l'account");
            session_unset(); //Unsetto tutte le variabili sessione
            session_destroy(); //Disrtuggo la sessione
            echo '<script>
                alert("Eliminazione profilo avvenuta con successo, arrivederci :)");
                window.location.href = "../home.php";
            </script>';
        }
    }
?>
<div class="pop-up-conferma">
    <form method="post" action="">
    <p><nobr>Sicuro di voler eliminare il profilo?</nobr></p>
    <button type="submit" name="elimina_profilo" class="btn btn-danger" id="elimina_profilo">Conferma Elimina :(</button>
    <button type="button" name="chiudi-popup" class="btn btn-success" id="chiudi-popup">Non confermare :)</button>
    </form>
</div>

<div class="container-fluid div_user_profile_info">
    <p class="titolo">Pagina Profilo Utente</p>
<div class="row">
    <div class="col-lg-6">
        <?php
        if($foto != "" && $foto != null){
            //Tolgo il primo . per poter essere localizzato nell'header
            $directory_foto = $foto;
            //Visualizzo la foto se e solo se essa l'utente cel abbia
            echo "
                <img src='$directory_foto'>
            ";
        }
        ?>
        <p>ID: <?php echo $id_utente; ?></p>
        <p>Tipo di utente: <?php echo $tipo; ?></p>
        <p>Nome = <?php echo $nome." ".$cognome;?></p>
        <?php if($indirizzo != "") echo '<p>Indirizzo = '.$indirizzo.' Civico = '.$civico.'</p>'; ?>
        <p>Citta = <?php echo $citta?></p>
        <p>telefono = <?php echo $telefono?></p>
        <p>email = <?php echo $email; ?></p>
        <?php if($dataora!=null && $id_utente === $x) echo "<p>Data e Ora registrazione ".$dataora;?></p>
    <?php
        //Devo fare così altriementi se un utente non loggato entra qui si generano dei warning
        //E devo passarlo tramite variabile senno non funziona
        //se sono l'utente proprietario della pagina vedo il tasto modifica
        if($id_utente === $x){
            echo '
                <button type="button" class="btn btn-danger" id="butt_req_modif_user">Modificare?</button>
            ';
        }else{
            //altrimenti visualizzo il tasto prenotazione
            echo '
                <form>
                    <button type="button" name="bt_accesso_sezione_prenotazione" class="btn btn-info" >Prenotare?</button>
                </form>
                ';
        }
    ?>

    </div>

    <div class="col-lg-6 ">

        <?php include_once('../Prenotazioni/orario_azienda.php'); ?>

    </div>


    <?php
        //se sono l'utente proprietario della pagina vedo il div modifica
        if($id_utente == $x){
            echo '
                <div class="col-lg-6 modifiche_profilo">
                    <form method="post" action="">
                        <p class="suggerimento_inserimento">Lasciare liberi i campi che non si intende modificare!</p>
                        <nobr>Modifica Nome: <input type="text" name = "nome"></nobr>
            ';
            if($tipo == "utente") echo "<br><nobr>Modifica Cognome: <input type = 'text' name='cognome'></nobr>";
            if(($tipo == "allevamento" || ($tipo == "canile")))
                echo "  <nobr>Modifica indirizzo: <input type='text' name='indirizzo'></nobr> <nobr>Modifica Civico: <input type='number' name='civico'></nobr>";
            echo '
                            <br><nobr>Modifica Citta: <input type="text" name ="citta"></nobr><br>
                            <p class="suggerimento_inserimento">Inserire un numero di telefono con 10 cifre</p>
                            <nobr>Modifica Telefono: <input type="number" name ="telefono"></nobr><br>
            ';
                            if($telefonoERR != "")
                                echo '<p class="error">$telefonoERR</p>';
                        echo 'Modifica email: <input type="email" name="email"><br>';
                            if($emailERR != "")
                                echo '<p class="error">$emailERR</p>';
            echo'                
                            <button type="submit" name="invia" class="btn btn-info">Invia Modifiche</button>
                        <button type="button" id="apri_pop_up_elimina" class="btn btn-danger">Elimina Profilo</button>
                    </form>
                </div>
            ';
        }else{


            echo '<div class="row-lg-6 ">';

            $conn = new mysqli("localhost", "root", "", "db_progetto") or die("Errore accesso database " . $conn->error);

            $query_pop_animali = "SELECT * FROM Animali WHERE Animali.proprietario = '" . $id_utente . "'";
            $ris = $conn->query($query_pop_animali);
            if (mysqli_num_rows($ris) > 0) {
                echo '<div class="container containerAnimali">
            <p class="titolo">Animali Presenti</p>
            <table class="table table-dark table-hover">
                <thead>
                <tr>
                    <th>Preferito</th>
                    <th>foto</th>
                    <th>id</th>
                    <th>Nome</th>
                    <th>razza</th>
                    <th>specie</th>
                    <th>eta</th>
                    <th>sesso</th>
                    <th>provenienza</th>
                    <th>pedigree</th>
                </tr>
                </thead>
                <tbody><form method="get" action ="gestisciPreferito.php">
                ';
                while ($row = $ris->fetch_assoc()) {
                    $perigree = "";
                    $id_animale = $row["id_animale"];
                    $utente_ospite_id = array_key_exists("id_utente", $_SESSION)?$_SESSION["id_utente"]: "";
                    echo "<tr>
                    <td>";

                    //Controllo se animale già presente nella tabella preferiti dell' utente
                        $ris3 = $conn->query("SELECT * FROM Preferiti WHERE animale='".$id_animale."' and utente ='".$utente_ospite_id."';")
                        or die("Errore sulla query di controllo preferiti");
                    if(mysqli_num_rows($ris3)==1){
                        echo"<a href='gestisciPreferito.php?anim=$id_animale&mode=rimuovi'>RimuoviPreferito</a>";
                    }
                    else{
                        echo"<a href='gestisciPreferito.php?anim=$id_animale&mode=inserisci'>InserisciPreferito</a>";
                    }
                    echo "    
                    </td>
                    <td><img src='" . $row["foto"] . "' width='50' height='50'></td>
                    <td>" . $id_animale . "</td>
                    <td>" . $row["nome"] . "</td>
                    <td>" . $row["razza"] . "</td> ";

                    $query_razza = "SELECT * FROM Razze WHERE Razze.razza = '" . $row["razza"] . "'";
                    $ris2 = $conn->query($query_razza) or die("Impossibile trovare la razza inserita");
                    if (mysqli_num_rows($ris2) > 0) {
                        $row2 = $ris2->fetch_assoc();
                        echo "<td>" . $row2["specie"] . "</td>";
                    }

                    echo "    
                    <td>" . $row["eta"] . "</td>
                    <td>" . $row["sesso"] . "</td>
                    <td>" . $row["provenienza"] . "</td>
                    <td>";
                    if ($row["pedigree"] == 1) $pedigree = "si"; else $pedigree = "no";
                    echo $pedigree . "</td>
                <tr>";
                }
                echo '</form> </tbody>
            </table>
        </div>
        ';
            }
            $conn->close();

            echo '</div>';

        }
    ?>

</div>

</div>

</body>
</html>
