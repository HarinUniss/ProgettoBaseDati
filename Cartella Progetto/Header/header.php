<?php

?>
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
            $pass = htmlspecialchars($_REQUEST['password']); //Assegnamento password

        }

    }

    if($userN!="" && $pass!=""){
        $servername = "localhost";
        $username = "root";
        $password = "";

        //crea connessione
        $conn = new mysqli("localhost", "root", "", "db_progetto");

        //Controllo connessione
        if($conn->connect_error){
            die("Connessione fallita: ".$conn->connect_error); //streammo l'errore di connessione
        }else{
            $sql_check_user = "SELECT select username
                    from credenziali
                    where credenziali.username = ". $userN;
            if($conn->query($sql_check_user) ){
                echo '<script type="text/javascript"> ';
                echo 'alert("Credenziali corrette")';
                echo '</script>';
            }else{
                echo '<script type="text/javascript"> ';
                echo 'alert("Credenziali non presenti nel nostro database...")';
                echo '</script>';
            }

        }


        $conn->close();
    }
?>

<nobr>
<div class="head container-fluid" >

        <!--placeholder permette che all'inserimento lettera, Search Scompare-->
        <!--Invisibile si attiva premendo il bottone di ricerca vedi funzioni_jQuery-->
        <!--<input type="text" id="baricerca" placeholder="search"><button id="butt_search"><img id="img_bt_src" src="./Immagini/search_icone.png" height="15" width="15"></button>
        -->
        <a class="login_button">
            <img id="prof" src="./Immagini/utente_img.png" height="25" width="25">
        </a>

</div>
    <div class="login_div">

        <form method="post" action="">
            <p><input type="button" class="close" value="close">
            Inserisci credenziali<br>
            <input type="text" id="input_username" placeholder="username" name="username"><p class="error"><?php echo $usernERR . $userN?></p>
            <input type="password" id="input_password" placeholder="password" name="password"><p class="error"><?php echo $passERR . $pass?></p><br>
            <button id="invia" type="submit" class="btn btn-info">Invia</button><input type="button" id="cancella" value="cancella"></p>
            <p>Se non sei registrato: <a href="">Registrati</a></p>
        </form>
    </div>

</html>