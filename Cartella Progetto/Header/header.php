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
    <script src="./script/header.js"></script>
</head>
<?php
    //Includo la classe utente
    include_once("ClassUtente.php");
    $nome_utente = "";
    $loginEffettuato = false;
?>
<?php

    $usernERR = $passERR = "";
    $userN = $pass = "";

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

            $sql_check_user = "SELECT C.proprietario
                FROM Credenziali AS C
                WHERE C.username = '$userN' AND C.password = '$pass';";
            $ris = $conn->query($sql_check_user) or die("Query errata per la ricerca dell' utente da lei inserito");

            //Se il numero di righe della query è 1 vuol dire che l'utente esiste
            if(mysqli_num_rows($ris)== 1){
                $id_proprietario = $ris->fetch_assoc()["proprietario"]; //Dato che mi basta solo l'id utente non ho bisogno di salvarmi il fetch...
                $query_pop_Utente_Loggato = "SELECT U.* FROM Utenti as U WHERE U.id_utente = ".$id_proprietario;
                $ris1 = $conn->query($query_pop_Utente_Loggato) or die("Query errata per la ricerca dell' utente da lei inserito2");
                if(mysqli_num_rows($ris1)== 1){
                    $row = $ris1->fetch_assoc();
                    $utente = new ClassUtente($row["id_utente"], $row["cognome"], $row["nome"], $row["indirizzo"], $row["civico"], $row["citta"], $row["telefono"], $row["email"], $row["foto"], $row["tipo"]);
                    $nome_utente = $utente->getNome();
                }else{
                    echo '<script type="text/javascript"> ';
                    echo 'console.log("Non è stato possibile salvare i dati dell utente")';
                    echo '</script>';
                }
                $loginEffettuato = true;
                echo '<script type="text/javascript"> ';
                echo 'alert("Credenziali corrette... benvenuto '.$utente->getNome().'")';
                echo '</script>';


            }else{
                echo '<script type="text/javascript"> ';
                echo 'alert("Credenziali non presenti nel nostro database")';
                echo '</script>';
            }
            $conn->close();
        }else{
            echo "<script type='text/javascript'>alert('Errore login, sono presenti dei campi vuoti')</script>";
        }

    }
?>

<nobr>
<div class="head container-fluid" >

        <!--placeholder permette che all'inserimento lettera, Search Scompare-->
        <!--Invisibile si attiva premendo il bottone di ricerca vedi funzioni_jQuery-->
        <!--<input type="text" id="baricerca" placeholder="search"><button id="butt_search"><img id="img_bt_src" src="./Immagini/search_icone.png" height="15" width="15"></button>
        -->
        <?php
        if($loginEffettuato==false){
            echo "<a class='login_button'>
                <img id='prof' src='./Immagini/utente_img.png' height='25' width='25'>
                </a>";
        }else{
            echo "<a class='login_button2'><img id='prof' src='./Immagini/utente_img.png' height='25' width='25'>$nome_utente</a>
                  <div class='tendina-login-button'>
                    <dl>
                     <dt><a href='#'>Profilo</a></dt>
                     <dt><button type='button' class='logout'>Logout<i class='bx bx-log-out' ></i></button></dt>
                    </dl>   
                  </div>";
        }
        ?>

        <?php /*echo $nome_utente; if($loginEffettuato===true)echo"<a class='dropdown-item' href='#'>Login</a>
        <a class='dropdown-item' href='#'>Profilo</a>
        <a class='dropdown-item' href='#'>Logout<i class='bx bx-log-out' ></i></a>"*/?>

    <!--<div class="dropdown-menu">
        <a class='dropdown-item' href='#'>Login</a>
        <a class='dropdown-item' href='#'>Profilo</a>
        <a class='dropdown-item' href='#'>Logout</a>
        </div>-->


</div>
    <?php
    if($loginEffettuato === false){
        echo '<div class="login_div">
        
            <form method="post" action="">
                <p><input type="button" class="close" value="close">
                Inserisci credenziali<br>
                <input type="text" id="input_username" placeholder="username" name="username"><p class="error"> '.$usernERR.'</p>
                <input type="password" id="input_password" placeholder="password" name="password"><p class="error"> '.$passERR.'</p><br>
                <button id="invia" type="submit" class="btn btn-info">Invia</button><input type="button" id="cancella" value="cancella"></p>
                <p>Se non sei registrato: <a href="./Contenuto Pagina/registrazione.php">Registrati</a></p>
            </form>
        </div>';
    }
    ?>



</html>