
$(document).ready(function(){ //Definisco le funzioni attivabilli dopo la pagina pronta

    $("#baricerca").hide(); //Nascondo la barra di ricerca
    /*$("div.login_div").hide();*/
    $("div.tendina-login-button").hide();
    $("div.tendina-gestione-appuntamenti").hide();
    /*--- Funzioni di apertura e chiusura del div di login*/

    /*$("a.login_button").click(function(){
        $("div.login_div").slideDown("fast");
    });*/
    $("button.but_show_tendina_appuntamenti").click(function (){
        $("div.tendina-gestione-appuntamenti").slideToggle();
    });
    $("input.close").click(function (){
        $("div.login_div").hide();
    });

    $("#annulla_reg").click(function (){
        $("div.pop-up-conferma").slideUp(900);
    });

    $("#cancella").click(function(){
        //Cancello il contenuto degli inp text dei login
        $("#input_username").val("");
        $("#input_password").val("");
    });


    $("button.login_button2").click(function(){
        $("div.tendina-login-button").slideToggle("fast");
    });

    var butt_search = $("#butt_search");
    butt_search.on({ //Si usa quando si verificano diverse azioni
        focus: function(){ //fix del bording del bottone di ricerca
            butt_search.css("outline","none");
        },
        mouseenter: function(){ //Quando il mouse passa sopra il bottone
            $("#img_bt_src").css("transform","rotate(45deg)"); //L'immmagine dentro ruota di 45 gradi
            butt_search.css("background-color", "lightgray");
        },
        mouseleave: function(){ //Quando esce, l'immagine torna alla sua posizione normale
            $("#img_bt_src").css("transform", "none");
            butt_search.css("background-color", "transparent");
        },
        click: function(){
            butt_search.css({"margin-left":"0px"}); //Non funziona
            $("#baricerca").toggle("slow");
        },
    });

});
function goToLoginPage(){
    window.location.href = "Contenuto Pagina/login.php";
}
function goToInserimentoOrario(){
    window.location.href = "Prenotazioni/inserimento_orario.php";
}

