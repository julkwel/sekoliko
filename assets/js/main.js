$(document).ready(function (e) {
    $('.datetimepicker').datetimepicker({
        format: 'YYYY-MM-DD HH:MM',
        icons: {
            time: 'ti-time',
            date: 'ti-calendar',
            up: 'ti-angle-up',
            down: 'ti-angle-down',
            previous: 'ti-angle-left',
            next: 'ti-angle-right',
            today: 'ti-calendar',
            clear: 'ti-trash',
            close: 'ti-close'
        },
    });

    // Custom file input bootstrap fix
    $('.custom-file-label').addClass('custom-file-control');
    $('.custom-file').addClass('d-block');
    $('.custom-file-input').on('change', function () {
        var fileName = $(this).val();
        $(this).next('.custom-file-label').html(fileName);
    })
});
