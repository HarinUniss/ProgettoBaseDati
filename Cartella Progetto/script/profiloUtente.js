$(document).ready(function(){
    $("div.modifiche_profilo").hide();
    $("div.pop-up-conferma").hide();

    $("#butt_req_modif_user").click(function (){
        $("div.modifiche_profilo").show(3000);
    });

    $("#chiudi-popup").click(function (){
        $("div.pop-up-conferma").hide(2000);
    });

    $("#apri_pop_up_elimina").click(function (){
        $("div.pop-up-conferma").show("slow");
    });
});
