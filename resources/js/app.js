
// ------ Include modules -------

window.Popper = require('popper.js').default;
window.$ = window.jQuery = require('jquery');

window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import { createApp, h } from 'vue';
import { createStore } from 'vuex'
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { setLogLevel } from 'webpack/hot/log';


(async function () {

    // ------- Store --------

    const store = createStore({

        state () {
            return {


                // Cart

                cartS: false,
                addProductCartS: {},
                cartCollectionS: {}
            }
        },

        mutations: {


            // Cart

            cartM(state) {

                state.cartS = !state.cartS;
            },

            addProductCartM(state, params) {

                state.addProductCartS = params;
            },

            cartCollectionM(state, value) {

                state.cartCollectionS = value;
            }
        }
    });


    // ------- Mixin --------

    let mixManifest = (await axios.get('/mix-manifest.json')).data;

    const mixin = {

        methods: {

            mix(path) {

                let realPath = '';

                if(path[0] != '/') {

                    path = '/' + path;
                }

                if(process.env.NODE_ENV == 'development') {

                    realPath = '//localhost:8080' + path;
                }
                else {

                    realPath = mixManifest[path];
                }

                return realPath;
            },

            route
        },
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
        .mixin(mixin)
        .use(InertiaPlugin)
        .use(store)
        .mount(el);

    InertiaProgress.init({ color: '#4B5563' });


    // ------- Clear console --------

    console.clear();
    setLogLevel('none');

    console.info = function () {
        if (arguments[0].indexOf('[webpack-dev-server]') == -1)
            return console.info.apply(console, arguments);
    };

}());