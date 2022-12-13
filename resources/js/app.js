
// ------ Include modules -------

window.Popper = require('popper.js').default;
window.$ = window.jQuery = require('jquery');


// window.axios = require('axios');
// window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import { createApp, h } from 'vue';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue3';
import { setLogLevel } from 'webpack/hot/log';
import { store } from './store';
import { appMixin } from "@/Mixins/app-mixin";



// ------- Prime Vue --------

import PrimeVue from 'primevue/config';

import 'primevue/resources/themes/lara-light-blue/theme.css';
import 'primevue/resources/primevue.min.css';
import 'primeicons/primeicons.css';


// ------- Inertia --------

const el = document.getElementById('app');

const app = createApp({

    created() {
        this.clearConsole();
    },

    methods: {

        clearConsole() {

            console.clear();
            setLogLevel('none');

            console.info = function () {
                if (arguments[0].indexOf('[webpack-dev-server]') == -1)
                    return console.info.apply(console, arguments);
            };

        }
    },

    render: () =>
        h(InertiaApp, {
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: (name) => require(`./Pages/${name}`).default,
        }),
})
    .mixin(appMixin)
    .use(InertiaPlugin)
    .use(PrimeVue)
    .use(store)


app.config.unwrapInjectedRef = true;

app.mount(el);
