<?php ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>



        <?php

                $conn = new mysqli("localhost", "root", "", "db_progetto") or die("Connessione fallita: " . $conn->connect_error); //streammo l'errore di connessione;

                $foto = $specie = $proprietario = $id_proprietario = $pedigree = "";

                $query_load_animali="SELECT * FROM Animali";

                $ris = $conn->query($query_load_animali) or die("Errore query Select animali ".$conn->error);
                if(mysqli_num_rows($ris) > 0){
        echo "<div class='box boxAnimali'>";
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
                        if($row["pedigree"] == 0) $pedigree = "NO";else $pedigree = "SI";
                        echo "
        
        <nobr>
        <img src='".$foto."'>
        <p>
        ";//ID: ".$row["id_animale"]."<br>
                        echo "Nome: ".$row["nome"]."<br>
        Razza: ".$row["razza"]." <br>
        Specie: ".$specie."<br>
        età: ".$row["eta"]."<br>
        sesso: ".$row["sesso"]."<br>
        provenienza: ".$row["provenienza"]."<br>
        Pedigree: ".$pedigree."<br>
        Proprietario: <a href = './Contenuto Pagina/profiloUtente.php?user=".$row["proprietario"]."'>".$proprietario."</a>
        </p></nobr>
        ";

                    }
        echo "<div>";
                }
                $conn->close();


        ?>

</html>
