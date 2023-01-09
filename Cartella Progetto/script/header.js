
$(document).ready(function(){ //Definisco le funzioni attivabilli dopo la pagina pronta

    $("#baricerca").hide(); //Nascondo la barra di ricerca
    $("div.login_div").hide();
    $("div.tendina-login-button").hide();

    /*$("a.h_img").click(function(){
    });//*/

    /*--- Funzioni di apertura e chiusura del div di login*/

    $("a.login_button").click(function(){
            $("div.login_div").slideDown("fast");
    });
    $("input.close").click(function (){
        $("div.login_div").hide();
    });

    $("#cancella").click(function(){
        $("#input_username").val("");
        $("#input_password").val("");
    });


    $("a.login_button2").click(function(){
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