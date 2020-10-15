$.fn.modal.Constructor.prototype.enforceFocus = function() {};

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(function() {
    $(document).on('click', function() {
        $('[data-toggle="tooltip"]').tooltip('hide');
    });

    $('[data-toggle="tooltip"]').tooltip({
        container: 'body',
        boundary: 'window',
        trigger: 'hover'
    });
});
