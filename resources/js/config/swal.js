const Swal = (window.Swal = require('sweetalert2'));

const SwalConfirm = (window.SwalConfirm = Swal.mixin({
    title: 'Confirmation',
    icon: 'question',
    customClass: {
        confirmButton: 'btn btn-outline-primary w-49',
        cancelButton: 'btn btn-light w-49',
        actions: 'swal2-actions-space-between'
    },
    confirmButtonText: 'YES',
    cancelButtonText: 'NO',
    showCancelButton: true,
    scrollbarPadding: false,
    focusConfirm: true,
    buttonsStyling: false,
    allowEnterKey: true,
    allowOutsideClick: false,
    showClass: {
        popup: 'animated fadeInDown faster'
    },
    hideClass: {
        popup: 'animated fadeOutUp faster'
    }
}));

const SwalLoading = (window.SwalLoading = Swal.mixin({
    showClass: {
        popup: 'animated fadeInDown faster'
    },
    hideClass: {
        popup: 'animated fadeOutUp faster'
    },
    showCancelButton: false,
    showConfirmButton: false,
    html: '<i class="fas fa-spinner fa-pulse"></i> Please wait...',
    allowEscapeKey: false,
    scrollbarPadding: false,
    focusConfirm: true,
    allowEnterKey: false,
    allowOutsideClick: false
}));

const SwalMessage = (window.SwalMessage = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-outline-primary btn-block',
        actions: 'swal2-actions-flex-end'
    },
    confirmButtonText: 'OK',
    showCancelButton: false,
    buttonsStyling: false,
    scrollbarPadding: false,
    focusConfirm: true,
    allowOutsideClick: false,
    showClass: {
        popup: 'animated fadeInDown faster'
    },
    hideClass: {
        popup: 'animated fadeOutUp faster'
    }
}));

const SwalTimeOut = (window.SwalTimeOut = Swal.mixin({
    title: 'Session expired due to page inactivity.',
    text: 'Page will refresh shortly',
    customClass: {
        confirmButton: 'btn btn-outline-primary btn-block',
        actions: 'swal2-actions-flex-end'
    },
    icon: 'info',
    confirmButtonText: 'REFRESH',
    showCancelButton: false,
    buttonsStyling: false,
    scrollbarPadding: false,
    focusConfirm: true,
    allowOutsideClick: false,
    showClass: {
        popup: 'animated fadeInDown faster'
    },
    hideClass: {
        popup: 'animated fadeOutUp faster'
    }
}));

$(document).keyup(function(e) {
    if (e.keyCode === 27) {
        if (SwalConfirm.isVisible()) {
            e.preventDefault();
        } else {
            $('.modal').modal('hide');
        }
    }
});

$(document).keyup(function(e) {
    if (SwalConfirm.isVisible()) {
        if (e.keyCode == 9) {
            e.preventDefault();
        }
    }
});
