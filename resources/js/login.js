try {
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
    require('./config/bootstrap');
    require('./config/swal');
    require('./config/livewire');
} catch(e) {
    console.error(e);
}
