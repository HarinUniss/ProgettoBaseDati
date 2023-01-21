<?php

$conn = new mysqli("localhost", "root", "", "db_progetto") or die("Errore di connessione: " . $conn->connect_error);


$q = $_REQUEST["q"];
$res="<option value='none' selected>none</option>";
$hint="SELECT DISTINCT razza FROM razze WHERE razze.specie='$q'" ;

$result = $conn->query($hint);
while($row = $result->fetch_assoc()) {
    $razza=$row["razza"];
$res .= "<option >".$razza."</option> ";
}
echo $res;
?>
