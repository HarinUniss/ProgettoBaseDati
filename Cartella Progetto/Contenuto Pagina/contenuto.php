<?php ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">

</head>

    <div class="box boxAnimali">

        <?php
        $conn = new mysqli("localhost", "root", "", "db_progetto") or die("Connessione fallita: " . $conn->connect_error); //streammo l'errore di connessione;
        if(isset($_SESSION["tipo"])){
            if($_SESSION["tipo"] == "Utente"){
                //Dato che la lista preferiti lo fa solo l'utente normale
                $sql_search_favourite = "SELECT * FROM Preferiti as P WHERE P.utente = ".$_SESSION["id_utente"];
                $ris = $conn->query($sql_search_favourite) or die("Errore query di ricerca preferiti");
                if(mysqli_num_row($ris) > 0){
                    echo "<p>PREFERITI</p>";
                    while($row = $ris->fetch_assoc()){
                        /*echo '<div class="box-inner">
                                <img src="">
                                <p>2  dsjoiahgv3  dsjoiahgv4  dsjoiahgv<br>5  dsjoiahgv6  dsjoiahgv</p>
                            </div>';*/
                    }
                }
            }
        }
        $foto = $specie = $proprietario = $id_proprietario = $pedigree = "";
        $query_load_animali="SELECT * FROM Animali";
        $ris = $conn->query($query_load_animali) or die("Errore query Select animali ".$conn->error);
        if(mysqli_num_rows($ris) > 0){

            while($row = $ris->fetch_assoc()){
                $foto = substr($row["foto"], 1); //Tolgo il primo punto altrimenti non me la vede

                //Caricamento razza
                $query_razza = "SELECT * FROM Razze WHERE Razze.razza = '".$row["razza"]."'";
                $ris2 = $conn->query($query_razza) or die("Query load razza errata");
                if(mysqli_num_rows($ris2) > 0){
                    $row2 = $ris2->fetch_assoc();
                    $specie = $row2["specie"];
                }

                //Caricamento del nome cognome proprietario
                $query_load_proprietario = "SELECT U.nome, U.cognome FROM Utenti as U WHERE id_utente = '".$row["proprietario"]."'";
                $ris3 = $conn->query($query_load_proprietario) or die("Query trovare nome proprietario errata");
                if(mysqli_num_rows($ris3) > 0){
                    $row3 = $ris3->fetch_assoc();
                    $proprietario = $row3["nome"]." ".$row3["cognome"];
                }
                if($row["pedigree"] == 0) $pedigree = "SI";else $pedigree = "NO";
                echo "
                <div class='box-inner Animale'>
                    <img src='".$foto."'>
                    <p>
                    ID: ".$row["id_animale"]."<br>
                    Nome: ".$row["nome"]."<br>
                    Razza: ".$row["razza"]."<br>   
                    Specie: ".$specie."<br>
                    età: ".$row["eta"]."<br>
                    sesso: ".$row["sesso"]."<br>
                    provenienza: ".$row["provenienza"]."<br>
                    Pedigree: ".$pedigree."<br>
                    Proprietario: <a href = './Contenuto Pagina/profiloUtente.php?user=".$row["proprietario"]."'>".$proprietario."</a><br>
                    
                    </p>
                <div>";
            }

        }
        $conn->close();

        ?>
        <!--<div class="box-inner">
            <img src="">
            <p>Descrizione Animale</p>
        </div>
        <div class="box-inner">
            <img src="">
            <p>Descrizione Animale</p>
        </div>-->
        <!--<div class="box-inner">
            <img src="">

                <p>Descrizione Animale <a href="./Contenuto Pagina/profiloUtente.php?user=3970800">Pinuccio</a>rehbrebrbregreherehrehre</p>

        </div>
        <div class="box-inner">
            <img src="">
            <p>Descrizione Animale</p>
        </div>-->
        <!--<div class="box-inner">
            <img src="">
            <p>Descrizione Animale</p>
        </div>
        <div class="box-inner">
            <img src="">
            <p>Descrizione Animale</p>
        </div>
        <div class="box-inner">
            <img src="">
            <p>Descrizione Animale</p>
        </div>
        <div class="box-inner">
            <img src="">
            <p>Descrizione Animale</p>
        </div>-->

    </div>

    <!--<div style="background-color: red;"><p>asvfbdwbvdewhbveilobvuwpbewweu</p></div>-->


</html>
