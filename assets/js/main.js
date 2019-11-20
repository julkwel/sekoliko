$(document).ready(function (e) {
    $('.datetimepicker').datetimepicker({
        format:'YYYY-MM-DD HH:MM',
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
    $('.custom-file-label').addClass('custom-file-control');
});