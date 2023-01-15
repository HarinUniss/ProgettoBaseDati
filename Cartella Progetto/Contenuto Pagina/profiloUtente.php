<?php

    if(isset($_SESSION["id_utente"])){
        echo '
            <form>
                <div name="foto" class="sezione-foto"></div>
            </form>
        ';
    }else{
        echo "Errore non è possibile accedere alla pagina";
    }
?>

