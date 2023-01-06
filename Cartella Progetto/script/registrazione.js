$(document).ready(function(){
    $("#div_nascondino").hide();
});

function checkType(form){
    $("option.f").remove();
    $("#div_nascondino").show();
        //Prendo il valore che ha il selettore di tipo nel form
    switch (form.elements["definizioneUser"].value){
        case "utente":{

            $("#cognome").show();
            $("p.indirizzo_civico").hide();
        }break;
        case "allevamento":{
            $("#cognome").hide();
            $("p.indirizzo_civico").show();
        }break;
        case "canile":{

            $("#cognome").hide();
            $("p.indirizzo_civico").show();
        }break;
    }
}
