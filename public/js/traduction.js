/**
 * Traduction et correction des textes
 */
$(document).ready(function(){    
    $("input[placeholder='Search for...']").attr("placeholder","Tapez ici votre recherche");
    $("label[for='form_prenom']").text("Prénom");
    $("label[for='form_username']").text("Nom d' utilisateur");
    $("a[title='Modifier']").css({
        "background-color":"#41c120",
        "border-color":"#41c120"
    });
    $("a[title='Modifier']").removeAttr("style");
});