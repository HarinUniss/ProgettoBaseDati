<?php session_start() ?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <!--<style>
        div.containerAnimali{
            margin: 0 auto;
        }
    </style>-->
    <link rel="stylesheet" href="../scss/main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>
<body>

<?php
    if(!isset($_SESSION["id_utente"])){
        echo '
            <script>
                alert("Non Puoi accedere a questa pagina, devi essere loggato!!!");
                window.location.href = "../home.php";
            </script>
        ';
    }
?>

  <?php
        $conn = new mysqli("localhost", "root", "", "db_progetto") or die("Errore accesso database ".$conn->error);

        $query_pop_animali = "SELECT * FROM Animali WHERE Animali.proprietario = '".$_SESSION["id_utente"]."'";
        $ris = $conn->query($query_pop_animali);
        if(mysqli_num_rows($ris) > 0){
            echo '<div class="container containerAnimali">
            <p class="titolo">Pagina Degli Animali Inseriti</p>
            <table class="table table-dark table-hover">
                <thead>
                <tr>
                    <th>rimuovi</th>
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
                <tbody><form method="get" action ="paginaConfermaCanc.php">
                ';
            while($row = $ris->fetch_assoc()){
                $perigree = "";
                $id_animale = $row["id_animale"];
                echo "<tr>
                    <td><a href='paginaConfermaCanc.php?anim=$id_animale'>rimuovi</a></td>
                    <td><img src='".$row["foto"]."' width='50' height='50'></td>
                    <td>".$id_animale."</td>
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
                <tr>";
            }
            echo '</form> </tbody>
            </table>
        </div>
        ';
        }else{
            echo '
            <script>
                alert("Non sono presenti Animali inseriti");
                window.location.href = "../home.php";
            </script>
            ';
        }
        $conn->close();
        ?>

</body>
</html>

