
// ------ Include modules -------

require('./bootstrap');
import { createApp, h } from 'vue';
import { createStore } from 'vuex'
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { setLogLevel } from 'webpack/hot/log';


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


// Inertia and App

const el = document.getElementById('app');

createApp({
    render: () =>
        h(InertiaApp, {
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: (name) => require(`./Pages/${name}`).default,
        }),
})
    .mixin({ methods: { route } })
    .use(InertiaPlugin)
    .use(store)
    .mount(el);

InertiaProgress.init({ color: '#4B5563' });


// Clear console

console.clear();
setLogLevel('none');

console.info = function () {
    if (arguments[0].indexOf('[webpack-dev-server]') == -1)
        return console.info.apply(console, arguments);
};