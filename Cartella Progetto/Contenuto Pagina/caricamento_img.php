<?php
function caricaIMG($dir_final){

    $fotoERR = $upload_percorso = "";
    if($_SERVER["REQUEST_METHOD"]=="POST") {

        // inserisco il percorso dove verranno caricate le foto in base alla sezione chiamante
        if($dir_final == "Utente"){$upload_percorso = '../Uploads/Utente/';}
        elseif ($dir_final == "Animali"){$upload_percorso = '../Uploads/Animali/';}

// salvo il percorso temporaneo dell'immagine caricata
        $file_tmp = $_FILES['img']['tmp_name'];
// salvo il nome dell'immagine caricata
        $file_nome = $_FILES['img']['name'];

        /*$immagine = file_get_contents($filetmp);
        $immagine = addslashes ($immagine);*/
        //echo "IL nome del file inserito è: ".$file_nome."<br>";

        //Controllo solo se la dimensione del file supera una soglia...
        if(filesize($file_tmp)>1048576){
            $fotoERR = "*Dimensione file troppo pesante: ".number_format( filesize($file_tmp)/1048576, 2)." > 1MB";
        }


        //Lettura dell' estensione del file
        /*//non funziona
        //$estensione = new SplFileInfo($filetmp);
        $estensione = pathinfo($filetmp, PATHINFO_EXTENSION);
        echo "L'estensione del file è: ".$estensione->getExtension()."<br>";*/

        //In alternativa posso controllare l'estensione usando str_contains...

        if((str_contains($file_nome, ".jpg") || str_contains($file_nome, ".png") || str_contains($file_nome, "jpeg"))&&($file_nome!= "")){

        }elseif($file_nome!= "")
            $fotoERR =  $fotoERR." IL file non è un immagine o un formato non accettabile";

        //echo "Dimensione del file: ".filesize($file_tmp)." Byte<br>";


        if($fotoERR == ""){ //Se non ho avuto errori...
            // ...sposto l'immagine nel percorso che prima abbiamo deciso
            if(move_uploaded_file($file_tmp, $upload_percorso . $file_nome)===true) {
                $_SESSION["nome_immagine"] = "$upload_percorso$file_nome";
                /*$dir = substr("$upload_percorso$file_nome", 1);
                echo "Il file è stato uploadato in: $dir<br>";*/
                echo "<img src='$upload_percorso$file_nome' height='100' width='100'>";
            }
        }else{
            echo "<p class='error'>".$fotoERR."</p>";
        }

    }
}
?>