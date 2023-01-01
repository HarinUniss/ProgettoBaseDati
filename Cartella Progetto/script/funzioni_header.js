
$(document).ready(function(){ //Definisco le funzioni attivabilli dopo la pagina pronta

    $("#baricerca").hide(); //Nascondo la barra di ricerca
    $("div.login_div").hide();
    /*$("a.h_img").click(function(){
    });//*/


    /*--- Funzioni di apertura e chiusura del div di login*/

    $("a.login_button").on({ //Imagine omino login
        click: function(){
            $("div.login_div").slideDown("fast");
        }
    });
    $("button.close").click(function (){
        $("div.login_div").hide();
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