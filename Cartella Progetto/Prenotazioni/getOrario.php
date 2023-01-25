<?php

$conn = new mysqli("localhost", "root", "", "db_progetto") or die("Errore di connessione: " . $conn->connect_error);
$ora= $res = "";

$azienda = $_REQUEST["azienda"];
$giorno = date('l', strtotime($_REQUEST["data"]));
if($giorno = "Monday"){
    $giorno = "lunedi";
}elseif($giorno = "Tuesday") $giorno = "martedi";
elseif($giorno = "Wednesday") $giorno = "mercoledi";
elseif($giorno = "Thursday") $giorno = "giovedi";
elseif($giorno = "Friday") $giorno = "venerdi";
elseif($giorno = "Saturday") $giorno = "sabato";
elseif($giorno = "Sunday") $giorno = "domenica";
$query="SELECT ora_inizio, ora_fine  FROM orario_apertura WHERE id_azienda='$azienda' and giorno = '$giorno'";
$result = $conn->query($query) or die("errore Query lettura orario apertura");

if(mysqli_num_rows($result)>0){
    $row = $result->fetch_assoc();
    $ora_inizio = strtotime($row["ora_inizio"]);
    $ora_fine=strtotime( $row["ora_fine"]);
    $ora = $ora_inizio;

    while($ora<$ora_fine) {
        $ora= strtotime("+ 30 minutes", $ora_inizio);
    }

}
$res .= "<option>".$ora."</option>";

echo $res;
?>