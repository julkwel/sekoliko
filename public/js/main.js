function supprimer(url){
    confirm("Voulez vous vraiment supprimer ?") ? window.location = url : '';
}

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
            "sEmptyTable": "Aucun utilisateur trouvé",
            "sInfo": "Voir _TOTAL_ de _PAGE_ pour _PAGES_ entrées",
        }
    });
});