<?php
$foto = $_POST["fotoDaUpload"];
if($foto) {
    $target_dir = "Uploads/Utente/"; //Directory di destinazione
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1; //variable di controllo, se 1 si effettua l'upload
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    function alertError($errore)
    {//Funzione che crea un alert con il tipo di errore
        echo '<script type="text/javascript"> ';
        echo 'alert($errore)';
        echo '</script>';
    }

// Controllo se l'immagine è un file immagine e non un altro tipo di file
    if (isset($_POST["submit"])) { //Controllo se è stato inserito qualcosa...
        //..Controllando la dimensione
        if (getimagesize($_FILES["fileToUpload"]["tmp_name"]) !== false) {
            $uploadOk = 1;
        } else {
            alertError("File is not an image.");
            $uploadOk = 0;
        }
    }

// Controllo se il file esiste
    if (file_exists($target_file)) {
        alertError("File inesistente");
        $uploadOk = 0;
    }

// Controllo peso immagine
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        alertError("File troppo pesante");
        $uploadOk = 0;
    }

// Controllo formato
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        alertError("Errore, si accettano solo file di tipo JPG, JPEG, PNG & GIF");
        $uploadOk = 0;
    }

// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        alertError("Sorry, your file was not uploaded.");
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            alertError("The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.");
        } else {
            alertError("Sorry, there was an error uploading your file.");
        }
    }
}
?>