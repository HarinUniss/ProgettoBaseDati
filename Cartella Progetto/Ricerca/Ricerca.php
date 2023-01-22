<?php session_start();//accedo alla variabile globale $_SESSION ?>
<!-- Fare in modo che una volta fatto il loghin la sessione resti aperta nelle altre pagine del sito! -->

<!DOCTYPE html>
<html>


<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/main.css"> <!--linko il css della HP-->
    <!--Includo la libreria di jQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="./script/funzioni_header.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>






    <script>


        $(document).ready(function(){
            $("#flip").click(function(){
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
                xmlhttp.open("GET","getRazza.php?q="+str,true);
                xmlhttp.send();
            }
        };
    </script>
    <style>
        div.containerAnimali{
            margin: 0 auto;
        }



        #panel{
            text-align: center;
            background-color: wheat;
            border-style: solid;
            max-width: 600px;
        }


        select{
            width: 100px;
        }
    </style>
</head>

<body>
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





<form id="form_ric" name="ricerca" method="post" action="" >
    <div >
        <input type="text" id="search_box" name="nome_animale" placeholder="inserire nome animale" class="input_text">
        <button type="submit" name="butt_ricerca" >Ricerca</button>
    </div>
    <div id="flip">
        Filtro
    </div>
    <div id="panel" class="container-fluid" style="display: none">
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
    </div>
</form>
<div>
    <?php
    echo $query_filtro;
    ?>
</div>


<div>
    <?php
       /* $conn = new mysqli("localhost", "root", "", "db_progetto") or die("Errore accesso database ".$conn->error);
    if(isset($_POST["butt_ricerca"])){
        $query_pop_animali = $query_filtro;
        $ris = $conn->query($query_pop_animali);
        if(mysqli_num_rows($ris) > 0){
            echo '<div class="container containerAnimali">
            <p class="titolo">Pagina Degli Animali Inseriti</p>
            <table class="table table-dark table-hover">
                <thead>
                <tr>
                    <th>rimuovi</th>
                    <th>modifica</th>
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
                <tbody>';
            echo "<tr>";
                echo "<td><a href =''>rimuovi</a></td>
                      <td><a href =''>modifica</a></td>";
            while($row = $ris->fetch_assoc()){
                echo "
                    <td><img src='".$row["foto"]."' width='50' height='50'></td>
                    <td>".$row["id_animale"]."</td>
                    <td>".$row["nome"]."</td>
                    <td>".$row["razza"]."</td> ";

                $query_razza = "SELECT * FROM Razze WHERE Razze.razza = '".$row["razza"]."'";
                $ris2 = $conn->query($query_razza) or die("Impossibile trovare la razza inserita");
                if(mysqli_num_rows($ris2) > 0){
                    $row2 = $ris2->fetch_assoc();
                    echo "<td>".$row2["specie"]."</td>";
                }

                echo "    
                    <td>".$row["eta"]."</td>
                    <td>".$row["sesso"]."</td>
                    <td>".$row["provenienza"]."</td>
                    <td>"; if($row["pedigree"] == 1) $pedigree = "si";else $pedigree = "no";
                echo $pedigree."</td>              
                ";

            }
            echo "<tr>";
        }else{
            echo '
            <script>
                alert("Non sono presenti Animali inseriti");
            </script>
            ';
        }
        $conn->close();
        echo ' </tbody>
            </table>
        </div>
        ';}*/
        ?>
</div>

</body>
</html>
