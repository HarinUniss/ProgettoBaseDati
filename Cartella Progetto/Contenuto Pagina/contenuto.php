<?php ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">

</head>
    <!--<div class="box">
        <div class=" element box-inner">1</div>
        <div class=" element box-inner">2</div>
        <div class=" element box-inner">1</div>
        <div class=" element box-inner">2</div>
        <div class=" element box-inner">1</div>
        <div class=" element box-inner">2</div>
        <div class=" element box-inner">1</div>
        <div class=" element box-inner">2</div>
    </div>-->

<div class="login_div">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];//Per fare riferimento a questo file?>">
        Inserisci credenziali<br>
        <input type="text" placeholder="email" name="email"><br>
        <input type="password" placeholder="password" name="password"><br><br>
        <button type="submit" class="btn btn-info">Invia</button><button id="cancella" class="btn btn-danger">Cancella</button>
    </form>
</div>
<?php
/*//Consiglio vivamente di non attivarlo per ora
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $us_em = htmlspecialchars($_REQUEST['email']); //Assegnamento email
    $us_ps = htmlspecialchars($_REQUEST['password']); //Assegnamento password
    if(empty($us_em)){ //Funzione empty, controlla se l'elemento dato in argomento è vuoto
        echo "* email non inserita";
    }
    if(empty($us_ps)){
        echo "* password non inserita";
    }
    if(!empty($us_em) && !empty($us_ps)){
        $user = new User($us_em, $us_ps);

        echo "<p id='str_credenz'>Email inserita: ".$us_em." Password inserita: ".$us_ps."</p>";
    }
}*/
?>

</html>
