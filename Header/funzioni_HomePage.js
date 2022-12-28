$(document).ready(function(){ //Definisco le funzioni attivabilli dopo la pagina pronta

    $("#baricerca").hide(); //Nascondo la barra di ricerca
    $("div.barra_sinistra").hide();

    $("a.h_img").click(function(){
        $("div.barra_sinistra").slideToggle("slow");
    });

    var butt_search = $("#butt_search");
    butt_search.on({ //Si usa quando si verificano diverse azioni
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