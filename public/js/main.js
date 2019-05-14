function supprimer(url){
    confirm("Voulez vous vraiment supprimer ?") ? window.location = url : '';
}

function renvoyer(url){
    confirm("Voulez vous vraiment renvoié l'utilisateur ?") ? window.location = url : '';
}

function annuleReserve(url){
    confirm("Voulez vous vraiment annuler la réservation ?") ? window.location = url : '';
}

$('.btn-success').addClass('text-white')

/**
 * DataTables
 */
$(document).ready(function() {
    $('#dataTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        "order": [[0, "desc"]],
        "bProcessing": true,
        "bFilter": true,
        "oLanguage": {
            "sProcessing": "Traitement...",
            "oPaginate": {
                "sPrevious": "Précédente", // This is the link to the previous page
                "sNext": "Suivante", // This is the link to the next page
            },
            "sSearch": "Filtrer: ",
            "sLengthMenu": "Afficher _MENU_ enregistrement par page",
            "sEmptyTable": "Aucun donées à été trouvé",
            "sInfo": "Voir _TOTAL_ de _PAGE_ pour _PAGES_ entrées",
        }
    });

    //Lightbox activation
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox();
    });

    //File input action
    $('#sk_bug_attachment, #sk_guide_attachment, #sk_userbundle_user_imgUrl').on('change', function (e) {
        var file = e.originalEvent.target.value;
        if (file){
            var fileName = file.split("\\");
            $("#label-file").text(fileName[fileName.length-1]);
        }else {
            $("#label-file").text('Aucun fichier choisi');
        }
    });
});




