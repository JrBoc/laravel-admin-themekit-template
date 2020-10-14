// requires SWAL.js

Livewire.on('openModal', function (mdl) {
    SwalLoading.close();

    if (!$(mdl.id).hasClass('show')) {
        $(mdl.id).modal('show');
    }

    if (mdl.hasOwnProperty('title')) {
        if (mdl.title != null) {
            $(mdl.id).find('.modal-title').html(mdl.title);
        }
    }
});

Livewire.on('closeModal', function (mdl) {
    if (mdl == null) {
        return $('.modal').modal('hide');
    }

    if (mdl.hasOwnProperty('id')) {
        if ($(mdl.id).hasClass('show')) {
            $(mdl.id).modal('hide');
        }
    }
});

Livewire.on('msg', function (msg) {
    SwalConfirm.close();
    SwalLoading.close();

    let status = 1;

    if (msg.hasOwnProperty('status')) {
        status = msg.status;
    }

    SwalMessage.fire({
        text: msg.message,
        icon: (status) ? 'success' : 'error',
    });
});

Livewire.on('closeDialogBox', function () {
    SwalLoading.close();
});
