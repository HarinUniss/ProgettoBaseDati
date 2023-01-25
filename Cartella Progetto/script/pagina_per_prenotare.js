$(document).ready(function(){
    $("div.pop-up-conferma").hide();
    $("button.invia").click(function(){
        $("div.pop-up-conferma").toggle("slow");
    });
    $("button.annulla").click(function (){
        $("div.pop-up-conferma").hide("slow");
    });
});
