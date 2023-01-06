<!DOCTYPE html>
<html lang = it>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Animali per amici</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/main.css"> <!--linko il css della HP-->
    <!--Includo la libreria di jQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="./script/funzioni_header.js"></script>

</head>

<?php

    $usernERR = $passERR = "";
    $userN = $pass = $nome ="";

    //Consiglio vivamente di non attivarlo per ora
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(empty($_POST["username"])){
            $usernERR = "username non inserito";
        }else {
            $userN = htmlspecialchars($_REQUEST['username']); //Assegnamento usarname;
        }
        if (empty($_POST["password"])) {
            $passERR = "password non inserita";
        }else{
            $pass = sha1(md5(sha1(htmlspecialchars($_REQUEST['password'])))); //Assegnamento password criptata
        }
        if($usernERR=="" && $passERR==""){
            $servername = "localhost";
            $username = "root";
            $password = "";

            //crea connessione
            $conn = new mysqli("localhost", "root", "", "db_progetto") or die("Connessione fallita: ".$conn->connect_error); //streammo l'errore di connessione;

            $sql_check_user = "SELECT C.username, C.password, C.proprietario
                FROM Credenziali AS C
                WHERE C.username = '$userN' AND C.password = '$pass';";
            $ris = $conn->query($sql_check_user) or die("Query errata per la ricerca dell' utente da lei inserito");
            $num = mysqli_num_rows($ris);
            if($num == 1){
                $id_utente = $ris->fetch_assoc()["id_utente"];
                $nome = $ris->fetch_assoc()["nome"];
                $query_pop_Utente_Loggato = "SELECT cognome, nome, foto, tipo FROM Utenti as U WHERE U.id_utente = ".$id_utente;
                echo '<script type="text/javascript"> ';
                echo 'alert("Credenziali corrette... benvenuto '.$nome.'")';
                echo '</script>';


            }else{
                echo '<script type="text/javascript"> ';
                echo 'alert("Credenziali non presenti nel nostro database")';
                echo '</script>';
            }

            $conn->close();
        }

    }
?>

<nobr>
<div class="head container-fluid" >

        <!--placeholder permette che all'inserimento lettera, Search Scompare-->
        <!--Invisibile si attiva premendo il bottone di ricerca vedi funzioni_jQuery-->
        <!--<input type="text" id="baricerca" placeholder="search"><button id="butt_search"><img id="img_bt_src" src="./Immagini/search_icone.png" height="15" width="15"></button>
        -->
        <a class="login_button">
            <img id="prof" src="./Immagini/utente_img.png" height="25" width="25"><?php echo "<a>$nome</a>";?>
        </a>

</div>
    <div class="login_div">

        <form method="post" action="">
            <p><input type="button" class="close" value="close">
            Inserisci credenziali<br>
            <input type="text" id="input_username" placeholder="username" name="username"><p class="error"><?php echo $usernERR?></p>
            <input type="password" id="input_password" placeholder="password" name="password"><p class="error"><?php echo $passERR?></p><br>
            <button id="invia" type="submit" class="btn btn-info">Invia</button><input type="button" id="cancella" value="cancella"></p>
            <p>Se non sei registrato: <a href="./Contenuto Pagina/registrazione.php">Registrati</a></p>
        </form>
    </div>

</html>