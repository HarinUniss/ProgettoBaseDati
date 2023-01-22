<?php ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>


        $(document).ready(function(){
            $("#butt_search").click(function(){
                $("#panel").slideToggle("slow");
            });
        });

        function mostraRazza(str) {
            if (str == "none") {
                document.getElementById("razza").disabled=true;
                document.getElementById("razza").innerHTML = '<option default value="none" selected>none</option>';
                return;
            } else {
                document.getElementById("razza").disabled=false;
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    document.getElementById("razza").innerHTML = this.responseText;
                };
                xmlhttp.open("GET","./Ricerca/getRazza.php?q="+str,true);
                xmlhttp.send();
            }
        };


    </script>
    <style>
        #panel{
            position: absolute;
            top:0;
            z-index: 120;
            text-align: center;
            background-color: wheat;
            border-style: solid;
            max-width: 600px;

        }
        #panel>select{
            width: 100px;
        }


    </style>
</head>

<?php
$nome_animale = $razza = $specie = $eta_min = $eta_max = $citta = $sesso = "";
$query_filtro="SELECT * FROM Animali as A";
$conn = new mysqli("localhost", "root", "", "db_progetto") or die("Errore di connessione: " . $conn->connect_error);  //connesione al server


$qy_citta="SELECT distinct provenienza FROM Animali";   //query per le citta disponibili nel filtro
$qy_specie="SELECT DISTINCT specie FROM razze";       //query per le specie disponibili nel filtro

if(isset($_POST["butt_ricerca"])){
    $query_filtro="SELECT * FROM Animali as A";
    if(isset($_POST["nome_animale"])){
        $nome_animale = $_POST["nome_animale"];
        if($nome_animale == ""){
            $query_nome_animale="";
        }
        else {

            {$query_filtro .=" WHERE ";}

            $query_nome_animale = "A.nome = '" . $nome_animale . "' ";
        }
        $query_filtro .= $query_nome_animale;
    }
    if(isset($_POST["Razza"])){
        $razza = $_POST["Razza"];
        if($razza == "none"){
            $query_razza="";
        }else {
            if($query_filtro=="SELECT * FROM Animali as A")
            {$query_filtro .=" WHERE ";}
            else
            {$query_filtro .= " AND ";}
            $query_razza = " A.razza = '" . $razza . "' ";
        }
        $query_filtro .= $query_razza;
    }
    if (isset($_POST["Sesso"])){
        $sesso = $_POST["Sesso"];
        if($sesso == "none"){
            $query_sesso="";
        }else {
            if($query_filtro=="SELECT * FROM Animali as A")
            {$query_filtro .=" WHERE ";}
            else
            {$query_filtro .= " AND ";}
            $query_sesso = "A.sesso = '" . $sesso . "' ";
        }
        $query_filtro .= $query_sesso;
    }
    if (isset($_POST["Eta_Min"])){
        $eta_min = $_POST["Eta_Min"];

        if($query_filtro=="SELECT * FROM Animali as A")
        {$query_filtro .=" WHERE ";}
        else
        {$query_filtro .= " AND ";}
        $query_sesso = "A.eta >= '" . $eta_min . "' ";

        $query_filtro .= $query_sesso;
    }
    if (isset($_POST["Eta_Max"])){
        $eta_max = $_POST["Eta_Max"];

        if($query_filtro=="SELECT * FROM Animali as A")
        {$query_filtro .=" WHERE ";}
        else
        {$query_filtro .= " AND ";}
        $query_sesso = "A.eta <= '" . $eta_max . "' ";

        $query_filtro .= $query_sesso;
    }
    if (isset($_POST["Pedigree"])){
        if($query_filtro=="SELECT * FROM Animali as A")
        {$query_filtro .=" WHERE ";}
        else
        {$query_filtro .= " AND ";}
        $query_pedigree = "A.Pedigree = 1 ";
        $query_filtro .= $query_pedigree;
    }

    if (isset($_POST["Citta"])){
        $citta = $_POST["Citta"];
        if($citta == "none"){
            $query_citta="";
        }else {
            if($query_filtro=="SELECT * FROM Animali as A")
            {$query_filtro .=" WHERE ";}
            else
            {$query_filtro .= " AND ";}
            $query_citta = "A.citta = '".$citta."' ";
        }
        $query_filtro .= $query_citta;
    }
}
?>




<div id="panel" class="container-fluid" style="display: none">
<form id="form_ric" name="ricerca" method="post" action="">

    <input type="text" id="search_box" name="nome_animale" placeholder="inserire nome animale" class="input_text">
    <button type="submit" name="butt_ricerca" >Ricerca</button>

    <!--<div id="flip">
        Filtro
    </div>-->

        <div class="row" id="riga">
            <div class="col-sm" id="colors_box1">
                <label for="specie">Specie</label>
                <select name="Specie" id="specie" onchange="mostraRazza(this.value)" >
                    <optgroup label="Specie">
                        <option  value="none" selected>none</option>
                        <?php
                        $result = $conn->query($qy_specie);
                        while($row = $result->fetch_assoc()) {
                            echo "<option >".$row["specie"]."</option> ";
                        }
                        ?>
                    </optgroup>
                </select>
                <br>
                <label for="razza">Razza</label>
                <select name="Razza" id="razza"  disabled>
                    <option value="none" selected>none</option>
                </select>
                <br>
                <label for="sesso">Sesso</label>
                <select name="Sesso" id="sesso">
                    <option value="none" selected>none</option>
                    <option value="f">Femmina</option>
                    <option value="m">Maschio</option>
                </select>
            </div>
            <div class="col-sm" id="colors_box2">
                <div id="blocco_eta">
                    Eta dell'animale:
                    da
                    <input name="Eta_Min" id="eta-min" type="number"  value="0" min="0" step="1"><br>
                    a
                    <input name="Eta_Max" id="eta-max" type="number" value="100" min="1" step="1">
                </div>
                <label for="pedigree">Pedigree</label>
                <input name="Pedigree" id="pedigree" type="checkbox" value="true">
            </div>
            <div class="col-sm" id="colors_box3">
                <label for="citta">Città</label>
                <select name="Citta" id="città">
                    <option value="none" selected >none</option>
                    <?php
                    $result = $conn->query($qy_citta);
                    while($row = $result->fetch_assoc()) {
                        echo "<option value=".$row["provenienza"].">".$row["provenienza"]."</option> ";
                    }
                    ?>
                </select>
            </div>
        </div>

</form>
</div>
<?php

$conn = new mysqli("localhost", "root", "", "db_progetto") or die("Connessione fallita: " . $conn->connect_error); //streammo l'errore di connessione;

$foto = $specie = $proprietario = $id_proprietario = $pedigree = "";

//$query_load_animali="SELECT * FROM Animali";
$query_load_animali = $query_filtro;

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
