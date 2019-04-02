/**
 * Suppression du fichier dans la base et dans le dossier
 */
function deleteFile(_id_file, _this) {
    // Récuperation url ajax
    var _url_ajax = $("#file-" + _id_file).attr("ajax-url");

    bootbox.confirm(
        "Etes vous sur de vouloir supprimer ce fichier ?",
        function(result) {
            if (result) {
                $.ajax({
                    type: "POST",
                    url: _url_ajax,
                    data: { 'id': _id_file },
                    cache: false,
                    success: function(_response) {
                        if (_response.success) {
                            _this.parents('.blc-image').remove();
                            bootbox.alert("Suppression avec succès !");
                        } else {
                            if (_response.message) {
                                bootbox.alert(_response.message);
                            }
                        }
                    }
                });
            }
        }
    );
}