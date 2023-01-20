<?php session_start(); ?>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="../script/registrazione.js"></script>
    <link rel="stylesheet" href="../scss/main.css">
</head>
<body>
<?php
    $id = $nome = $foto = $provenienza = $specie = $razza = $eta = $pedigree =$proprietario ="";
    $nomeERR = $fotoERR = $provenienzaERR = $razzaERR = $pedigreeERR = $etaERR = "";
    //Impostiamo la data e l'ora di roma...
    date_default_timezone_set("Europe/Rome");

    if(!isset($_SESSION["tipo"])){
        //Se l'utente non è loggato lo rimando alla home
        header('Location: ../home.php');
    }else{
        include_once('caricamento_img.php');
        caricaIMG("Animali");


            if(isset($_POST["invia"])){

                //Controlli su immagine
                if(isset($_SESSION["nome_immagine"])) {
                    //Controllo su immagine inserita da utente...
                    $nomeImmagine = array_key_exists('nome_immagine', $_SESSION) ? $_SESSION['nome_immagine'] : "";
                    //Inserisco nel database la directory dove è presente la foto...
                    if (file_exists($nomeImmagine)) {
                        $foto = addslashes($nomeImmagine);
                        unset($_SESSION['nome_immagine']);//unsetta la var sessione "nomeimmagine"
                    }elseif($nomeImmagine == ""){
                        $fotoERR ="La foto non è stata caricata";
                    }

                }else{
                    $fotoERR = "Nessuna Foto inserita";
                }

                //Controlli su nome
                $nome = htmlspecialchars($_REQUEST["nome"]);
                if (empty($nome)) {
                    $nomeERR = "*Nome non impostato";
                } else {
                    $nome = ucfirst(strtolower(ltrim($nome))); //Mi elimina gli spazi "bianchi"(inutili) inseriti dall' utente
                }

                //Controllo su specie
                $specie = htmlspecialchars($_REQUEST["specie"]);
                if (!empty($specie)) {
                    $specie = ucfirst(strtolower(ltrim($specie))); //Mi elimina gli spazi "bianchi"(inutili) inseriti dall' utente
                }

                //Controllo su razza
                $razza = htmlspecialchars($_REQUEST["razza"]);
                if (!empty($razza)) {
                    $razza = ucfirst(strtolower(ltrim($razza))); //Mi elimina gli spazi "bianchi"(inutili) inseriti dall' utente
                }else{
                    $razzaERR ="*Obbligatorio Inserire almeno una razza";
                }

                $sesso = htmlspecialchars($_REQUEST["sesso"]);

                //Controllo provenienza
                if(isset($_POST["provenienza1"])&& $_POST["provenienza1"] != ""){ //Ha priorità il select
                    $provenienza = htmlspecialchars($_REQUEST["provenienza1"]);
                }elseif(isset($_POST["provenienza2"])&& $_POST["provenienza1"] == ""){
                    $provenienza = htmlspecialchars($_REQUEST["provenienza2"]);
                }else $provenienzaERR = "*Provenienza non inserita";


                //Controllo eta >0
                $eta = htmlspecialchars($_REQUEST["eta"]);
                if($eta < 0){
                    $etaERR ="*Reinserire un età maggiore di zero per favore...";
                }

                //Controllo su inserimento pedigree
                //Dato che il pedigree dev'essere obbligatorio per un animale inserito da un allevamento
                //Faccio il controllo solo sull'allevamento...
                if((!isset($_POST["pedigree"]) || $_POST["pedigree"] == 0) && $_SESSION["tipo"] == "allevamento"){
                    $pedigreeERR = "*Pegigree obbligatorio per animali inseriti da allavamento";
                }elseif(isset($_POST["pedigree"]) ){
                    $pedigree = 1;
                    echo "Patata";
                }

                $errori = $nomeERR.$fotoERR.$provenienzaERR.$pedigreeERR.$etaERR;

                //Se non ho avuto alcun errore inizio la procedura di inserimento nel db
                if($errori == ""){
                    $conn = new mysqli("localhost", "root", "", "db_progetto")
                    or die("Impossibile collegarsi al database ".$conn->error);
                    echo "Arriva all'apertura del database? Qui arriva";
                    //Inizio Generazione id...
                    $esiste = true;

                    while($esiste != false){
                        echo "Arriva alla query dell' id";
                        $id = rand(0, 9999999); //Limite di 10Mega
                        $query_check_id_animal = "SELECT id_animale FROM Animali as A WHERE A.id_animale = '$id'";
                        $ris = $conn->query($query_check_id_animal) or die("Query check id animale errata ".$conn->error);
                        if(mysqli_num_rows($ris)==0){
                            $esiste = false;
                        }
                    }
                    $proprietario = $_SESSION["id_utente"];//Salvo l'id dell' utente loggato che sta inserendo l'animale
                    $dataora_registrazione = date("Y-m-d h:i:sa");

                    //Controllo se la razza esiste già
                    $query_check_ifexist_razza = "SELECT * FROM Razze where razza = '$razza'";
                    $ris = $conn->query($query_check_ifexist_razza) or die("Query check razza animale errata ".$conn->error);
                    if(mysqli_num_rows($ris) == 0){
                        $query_inserimento_razza_specie = "INSERT INTO Razze(razza, specie) VALUES ('$razza', '$specie')";
                        $conn->query($query_inserimento_razza_specie) or die("Errore inserimento razza ".$conn->error);
                    }
                    $query_registrazione_animale = "INSERT INTO Animali(id_animale, nome, razza, eta, sesso, provenienza, pedigree, foto, proprietario, dataora) 
                                    VALUES('$id', '$nome', '$razza', '$eta', '$sesso', '$provenienza', '$pedigree', '$foto', '$proprietario', '$dataora_registrazione');";
                    $conn->query($query_registrazione_animale) or die("Errore nella query di inserimento dell' animale ".$conn->error);

                    echo '<script>
                        alert("Registrazione Avvenuta con successo :)");
                        window.location.href = "../home.php"
                    </script>';

                }else{
                    echo '<script>
                        alert("Ops qualcosa è andato storto, Registrazione non compiuta :(");
                    </script>';
                }

            }


    }
?>

<div class="form-group">
    <p class="titolo">Benvenuto nella pagina di REGISTRAZIONE ANIMALI</p>
    <!--enctype indica che i file che trasferiamo sono di tipo diverso del testo-->
    <form method="post" action="" enctype="multipart/form-data">
        <div class="pop-up-conferma">
            <p><nobr>Sicuro di voler confermare?</nobr></p>
            <p>
                <button type="submit" name="invia" class="btn btn-danger" id="invia_reg">conferma</button><button type="button" name="cancella" class="btn btn-secondary" id="annulla_reg">annulla</button>
            </p>
        </div>
            <p class="suggerimento_inserimento">Dimensione immagine max: 5MByte</p>
            Foto <input type="file" name="img" id="FotoToUpload" ><br><?php echo "<p class='error'>$fotoERR</p>";?>

            <input type="text" id="nome" placeholder="Nome" name="nome"><?php echo "<p class='error'>$nomeERR</p>"?>

            <!--<label for="specie">Specie</label>
            <select name="specie" id="specie">
                <option value="none">none</option>
            </select>-->
            <input type="text" name="specie" placeholder="Specie">

            <!--<label for="razza">Razza</label>
            <select name="razza" id="razza">
                <option value="none">none</option>
            </select>-->
            <input type="text" name="razza" placeholder="Razza"><?php echo "<p class='error'>$razzaERR</p>"?>

            <label for="sesso">Sesso</label>
            <select name="sesso" id="sesso">
                <option value="femmina">F</option>
                <option value="maschio">M</option>
            </select><br>

            <label for="provenienza">Provenienza</label>
            <select name="provenienza1" id="provenienza1">
                <option></option>
                <?php
                $citta = "";
                $conn = new mysqli("localhost", "root", "", "db_progetto") or die("Errore di connessione: " . $conn->connect_error);

                //Per la sezione di ricerca per città abbiamo fatto una query
                $query="SELECT distinct citta FROM Utenti UNION
                        SELECT distinct provenienza FROM Animali";
                $result = $conn->query($query);
                if ((mysqli_num_rows($result) > 0)) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        $citta = $citta.$row["citta"];
                        echo "<option>".$row["citta"]."</option> ";
                    }
                } else {
                    echo "Nessuna Città presente nel database";
                }

                $conn->close(); //Chiudo la connessione al db

                ?>
            </select><br>

            <p class="suggerimento_inserimento">Inserire solo se non presente nella sezione precedente</p>
            Provenienza: <input type="text" id="provenienza2" name="provenienza2"><?php echo "<p class='error'>$provenienzaERR</p>"?>

            Età<input type="number" name="eta" id="civico" maxlength="4"><?php echo "<p class='error'>$etaERR</p>";?> Pedigree<input type="checkbox" name="pedigree"><?php if($_SESSION["tipo"] == "allevamento")echo "<p class='error'>$pedigreeERR</p><p class='suggerimento_inserimento'>Pedigree Obbligatorio</p>"?>

            <button type="button" name="button_invia" id="but_active_pop_up_conferma" class="btn btn-info">Invia</button>
    </form>
</div>
</body>
</html>