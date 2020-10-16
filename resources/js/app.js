try {
    window._ = require('lodash');

    window.axios = require('axios');
    window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

    window.Popper = require('popper.js').default;
    window.PerfectScrollbar = require('perfect-scrollbar').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
    require('datatables.net');
    require('datatables.net-bs4');
    require('datatables.net-plugins/pagination/input');
    require('select2');
    require('./plugins/jquery.numeric');
    require('./plugins/themekit');

    require('./config/bootstrap');
    require('./config/swal');
    require('./config/livewire');
    require('./config/datatables');
} catch (e) {
    console.error(e);
}
