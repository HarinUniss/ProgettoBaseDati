<?php session_start();?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <!--<script src="./script/header.js"></script>-->
    <link rel="stylesheet" href="../scss/main.css">
    <script src="../script/login.js"></script>
</head>
<body>
<?php

//Ci permette di fare in modo che se un utente appena registrato tenta di entrare in login, ipoteticamente
//Se dovesse accedere alla pagina, si unsettano tutte le variabili session per sicurezza, anche in caso di logout
/*$logout_ = array_key_exists('logout', $_GET)? $_GET['logout']: "";
$req_by_reg = array_key_exists('reg', $_GET)? $_GET['reg']: "";*/

//Se un utente già loggato entra in questa pagina viene reindirizzato alla home
    if(isset($_SESSION["nome_utente"])) {
        header('Location: ../home.php');
    }


$usernERR = $passERR = "";
$userN = $pass = "";

if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(isset($_POST["login"])){ //Se la richiesta arriva dal form di login effettua questo...
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
                    //In teoria non si dovrebbero salvare quà ma in un altra pagina
                    //Per questioni di maggiore sicurezza...
                    $_SESSION["id_utente"] = $row["id_utente"];
                    $_SESSION["nome_utente"] = $row["nome"];
                    $_SESSION["cognome_utente"] = $row["cognome"];
                    $_SESSION["indirizzo_utente"] = $row["indirizzo"];
                    $_SESSION["civico"] = $row["civico"];
                    $_SESSION["citta"] = $row["citta"];
                    $_SESSION["telefono"] = $row["telefono"];
                    $_SESSION["email"] = $row["email"];
                    $_SESSION["tipo"] = $row["tipo"];
                    $_SESSION["foto"] = $row["foto"];
                    $_SESSION["dataora"] = $row["dataora"];
                }else{
                    echo '<script type="text/javascript"> ';
                    echo 'console.log("Non è stato possibile salvare i dati dell utente")';
                    echo '</script>';
                }


                    echo '
                        <script>
                            alert("Credenziali corrette Benvenuto '.$_SESSION["nome_utente"].'");
                            window.location.href = "../home.php";
                        </script>
                    ';

            }else{
                echo '<script type="text/javascript"> ';
                echo 'alert("Credenziali non presenti nel nostro database")';
                echo '</script>';
            }
            $conn->close();
        }/*else{
            echo "<script type='text/javascript'>alert('Errore login, sono presenti dei campi vuoti')</script>";
        }*/

    }/*elseif (isset($_POST["logout"])){ //Se la richiesta arriva dal form di logout esegue questo
        //$_SESSION["loginEffettuato"] = false;
        session_unset(); //Rimuove ogni variabile di sessione create
        //session_destroy(); //Distrugge la sessione
        echo '<script type="text/javascript">alert("logout effettuato, arrivederci")</script>';
    }*/
}

?>

<div class="login_div container">

    <form method="post" action="" class="form-inline form_login">
        <p><p class="error">Pagina di Login</p><input type="button" class="close" onclick=returnHomePage() value="close">
            Inserisci credenziali<br>
            <input type="text" id="input_username" class="form-control mb-2 mr-sm-2" placeholder="username" name="username"><p class="error"> <?php echo $usernERR;?></p>
            <input type="password" id="input_password" class="form-control mb-2 mr-sm-2" placeholder="password" name="password"><p class="error"> <?php echo $passERR;?> </p><br>
        <button id="invia" type="submit" name="login" class="btn btn-info">Invia</button><button id="cancella" type="button" class="btn btn-danger">cancella</button></p>
        <p>Se non sei registrato: <a href="registrazione.php">Registrati</a></p>
    </form>

</div>


</body>
</html>
