$(document).ready(function(){
    $("#cancella").click(function(){
        //Cancello il contenuto degli inp text dei login
        $("#input_username").val("");
        $("#input_password").val("");
    });

    $("#annulla_reg").click(function (){
        $("div.pop-up-conferma").slideUp(900);
    });
});

function returnHomePage(){
    window.location.href = "../home.php";
}
