try {
    window.$ = window.jQuery = require('jquery');

    require('foundation-sites')

    $(function () {
        $(document).foundation();
        $(".open-form").on('click', function (event) {
            event.preventDefault();
            $("#"+$(this).attr('data-open')).addClass('d-flex');
        });
        $("#modals").on('click', '.close-form', function (event) {
            event.preventDefault();
            $(this).parent().parent().parent().removeClass('d-flex');
        });
    })
} catch (e) {}
require('./bootstrap');
