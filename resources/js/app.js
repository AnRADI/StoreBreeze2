
// ------ Include modules -------

window.Popper = require('popper.js').default;
window.$ = window.jQuery = require('jquery');

require('bootstrap');


window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

//console.log(require(path.resolve('resources') + '/lang/ru.json'));

import { mapMutations, mapState } from 'vuex'
import { createApp, h } from 'vue';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { setLogLevel } from 'webpack/hot/log';
import { store } from './store';
//console.log($page.props.resource_path);
// import kk from 'resources/lang/ru.json';


(async function () {


    // ------- Mixin --------

    let mixManifest = (await axios.get('/mix-manifest.json')).data;

    // let ff = (await axios.get('resources/lang/ru.json')).data;


    const mixin = {

        computed: {
            ...mapState(Object.getOwnPropertyNames(store._state.data)),

            // ttt() {
            //     return require(this.$page.props.resource_path + '/lang/ru.json');
            // }
            translations() {
                return this.$page.props.translations;
            }
        },

        methods: {
            ...mapMutations(Object.getOwnPropertyNames(store._mutations)),

            can(permission) {

                let DBPermissions = this.$page.props.permissions;

                for(let DBPermission of DBPermissions) {

                    if(DBPermission.name == permission) {
                        return true;
                    }
                }

                return false
            },

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

                    if(!realPath) realPath = path;
                }

                return realPath;
            },

            __(key, params = {}) {

                let translation = this.translations[key] ?? key;

                Object.keys(params).forEach(paramName => {

                    translation = translation.replace(':' + paramName, params[paramName]);
                });

                return translation;
            },

            route
        },
    };


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
        .mixin(mixin)
        .use(InertiaPlugin)
        .use(store)
        .mount(el);

    //InertiaProgress.init({ color: '#4B5563' });

}());