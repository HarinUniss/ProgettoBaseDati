$(document).ready(function(){
    $("#div_nascondino").hide();
    $("div.pop-up-conferma").hide();
    $("#but_active_pop_up_conferma").click(function(){
        $("div.pop-up-conferma").slideToggle(900);
    });
    $("#invia_reg").click(function (){
        $("div.pop-up-conferma").hide();
    });
    $("#annulla_reg").click(function (){
        $("div.pop-up-conferma").slideToggle(900);
    });

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

