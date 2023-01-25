<?php

$conn = new mysqli("localhost", "root", "", "db_progetto") or die("Errore di connessione: " . $conn->connect_error);

$azienda = $_REQUEST["azienda"];
$ora= "";
$res = "";


$giorno = date('l', strtotime($_REQUEST["giorno"]));
if($giorno == "Monday"){$giorno = "lunedi";}
elseif($giorno == "Tuesday") $giorno = "martedi";
elseif($giorno == "Wednesday") $giorno = "mercoledi";
elseif($giorno == "Thursday") $giorno = "giovedi";
elseif($giorno == "Friday") $giorno = "venerdi";
elseif($giorno == "Saturday") $giorno = "sabato";
elseif($giorno == "Sunday") $giorno = "domenica";
$query="SELECT ora_inizio, ora_fine  FROM orario_apertura WHERE id_azienda='$azienda' and giorno = '$giorno'";
$result = $conn->query($query) or die("errore Query lettura orario apertura");

if(mysqli_num_rows($result)>0){
    $row = $result->fetch_assoc();
    $ora_inizio = strtotime($row["ora_inizio"]);
    $ora_fine=strtotime("", $row["ora_fine"]);
    $ora = $ora_inizio;
    while($ora<$ora_fine) {

        $res .= "<option>".date("h:i",$ora)."</option>";
        $ora= strtotime("+ 30 minutes", $ora);
    }

}


echo $res;
?>