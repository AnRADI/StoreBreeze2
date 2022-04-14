
// ------ Include modules -------

window.Popper = require('popper.js').default;
window.$ = window.jQuery = require('jquery');

require('bootstrap');

window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import { createApp, h } from 'vue';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue3';
import { setLogLevel } from 'webpack/hot/log';
import { store } from './store';
import { appMixin } from "@/mixins";


// ------- Clear console --------

console.clear();
setLogLevel('none');

console.info = function () {
    if (arguments[0].indexOf('[webpack-dev-server]') == -1)
        return console.info.apply(console, arguments);
};


// ------- Inertia --------

const el = document.getElementById('app');

createApp({


    render: () =>
        h(InertiaApp, {
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: (name) => require(`./Pages/${name}`).default,
        }),
})
    .mixin(appMixin)
    .use(InertiaPlugin)
    .use(store)
    .mount(el);


