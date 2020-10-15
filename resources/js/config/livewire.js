// requires SWAL.js

Livewire.on('openModal', function(mdl) {
    SwalLoading.close();

    if (!$(mdl.id).hasClass('show')) {
        $(mdl.id).modal('show');
    }

    if (mdl.hasOwnProperty('title')) {
        if (mdl.title != null) {
            $(mdl.id)
                .find('.modal-title')
                .html(mdl.title);
        }
    }
});

Livewire.on('closeModal', function(mdl) {
    if (mdl == null) {
        return $('.modal').modal('hide');
    }

    if (mdl.hasOwnProperty('id')) {
        if ($(mdl.id).hasClass('show')) {
            $(mdl.id).modal('hide');
        }
    }
});

Livewire.on('msg', function(msg) {
    SwalConfirm.close();
    SwalLoading.close();

    let status = 1;

    if (msg.hasOwnProperty('status')) {
        status = msg.status;
    }

    SwalMessage.fire({
        text: msg.message,
        icon: status ? 'success' : 'error'
    });
});

Livewire.on('closeDialogBox', function() {
    SwalLoading.close();
});

Livewire.onError(function(status_code) {
    $('.modal').modal('hide');

    SwalConfirm.close();
    SwalLoading.close();

    switch (status_code) {
        case 404:
            SwalMessage.fire({
                icon: 'error',
                title: 'Selected Resource Not Found'
            });

            return false;
        case 413:
            setTimeout(function() {
                location.reload(true);
            }, 30000);

            SwalTimeOut.fire().then(function() {
                location.reload(true);
            });

            return false;
        default:
            return true;
    }
});
