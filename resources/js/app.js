
// Include modules...
require('./bootstrap');
import { createApp, h } from 'vue';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { setLogLevel } from 'webpack/hot/log';


// Inertia
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
    .mount(el);

InertiaProgress.init({ color: '#4B5563' });


// Clear console
console.clear();
setLogLevel('none');

console.info = function () {
    if (arguments[0].indexOf('[webpack-dev-server]') == -1)
        return console.info.apply(console, arguments);
};
