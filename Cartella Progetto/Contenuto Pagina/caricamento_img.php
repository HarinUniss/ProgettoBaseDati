<?php
/*
if(isset($_POST["invia"])){
    $carica_fotoERR = "";

    // inserisco il percorso dove verranno caricate le foto
    $upload_percorso = '../Uploads/Utente/';
    // salvo il percorso temporaneo dell'immagine caricata
    $filetmp = $_FILES['FotoUpload']['tmp_name'];
    // salvo il nome dell'immagine caricata
    $file_nome = $_FILES['FotoUpload']['name'];
    $_SESSION["dir_immagine"] = "$upload_percorso$file_nome";

    //Controllo solo se la dimensione del file supera una soglia...
    if(filesize($filetmp)>5000000){
        $carica_fotoERR = "*Dimensione file troppo pesante: ".(filesize($filetmp)/1024)."KB > 5MB<br>";
    }

    //Controllo dell' estensione del file, posso controllare l'estensione usando str_contains...
    if(str_contains($file_nome, ".jpg") || str_contains($file_nome, ".png") || str_contains($file_nome, "jpeg")){}
    else{
        $carica_fotoERR = $carica_fotoERR." *IL file non è un immagine o un immagine con formato non valido, inserire formati jpg, png, jpeg.<br>";
    }
    echo "<script>alert('File non caricato');</script>";
    // sposto l'immagine nel percorso che prima abbiamo deciso
    if(move_uploaded_file($filetmp, $upload_percorso . $file_nome)===true){
        echo "Il file: $file_nome è stato salvato in: $upload_percorso";
    }else{
        echo "<script>alert('File non caricato');</script>";
    }

}
*/
?>

<?php

if($_SERVER["REQUEST_METHOD"]=="POST") {
// inserisco il percorso dove verranno caricate le foto
    $upload_percorso = '../Uploads/Utente/';
// salvo il percorso temporaneo dell'immagine caricata
    $file_tmp = $_FILES['img']['tmp_name'];
// salvo il nome dell'immagine caricata
    $file_nome = $_FILES['img']['name'];
    $_SESSION["nome_immagine"] = "$upload_percorso$file_nome";
    /*$immagine = file_get_contents($filetmp);
    $immagine = addslashes ($immagine);*/
    echo "IL nome del file inserito è: ".$file_nome."<br>";
//Controllo solo se la dimensione del file supera una soglia...
    if(filesize($file_tmp)>1000000){
        echo "Dimensione file troppo pesante: ".filesize($file_tmp)." > 1MB<br>";
    }


    //Lettura dell' estensione del file
    /*//non funziona
    //$estensione = new SplFileInfo($filetmp);
    $estensione = pathinfo($filetmp, PATHINFO_EXTENSION);
    echo "L'estensione del file è: ".$estensione->getExtension()."<br>";*/

    echo "In alternativa posso controllare l'estensione usando str_contains...<br>";

    if(str_contains($file_nome, ".jpg") || str_contains($file_nome, ".png") || str_contains($file_nome, "jpeg")){
        echo "Il file è un immagine<br>";
    }else
        echo "IL file non è un immagine<br>";

    echo "Dimensione del file: ".filesize($file_tmp)." Byte<br>";

// sposto l'immagine nel percorso che prima abbiamo deciso
    if(move_uploaded_file($file_tmp, $upload_percorso . $file_nome)===true) {
        //Tolgo il primo punto per poterlo usare nell'' header del progetto
        $dir = substr("$upload_percorso$file_nome", 1);
        echo "Il file è stato uploadato in: $dir<br>";
        echo "<img src='$upload_percorso$file_nome' height='100' width='100'>";
    }
    /*
        if(isset($_POST["submit"])){
            $conn = new mysqli('localhost', 'root', '', 'database_prova1') or die("Errore di connesione al database");
            $id = rand(0, 9999999);


            if($conn->query("INSERT INTO Foto(id_foto, foto, proprietario) VALUES ('$id', '$immagine', '1')")){
                echo "Foto inserita nel database con successo";
            }else{
                die("Upload to database failed");
                echo "Foto non inserita";
            }
        }
    */
}
?>
