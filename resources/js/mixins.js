

import { mapMutations, mapState } from "vuex";
import { store } from './store';
import { Link, Head } from '@inertiajs/inertia-vue3';


// ------- App mixin --------

export const appMixin = {

    components: {
        Link, Head
    },

    computed: {
        ...mapState(Object.keys(store._state.data)),

        translations() {
            return this.$page.props.translations;
        }
    },


    methods: {
        ...mapMutations(Object.keys(store._mutations)),

        can(permission) {

            let DBPermissions = this.$page.props.permissions;

            for(let DBPermission of DBPermissions) {

                if(DBPermission.name == permission) {
                    return true;
                }
            }

            return false
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


// ------- Cart mixin --------

export const cartMixin = {

    computed: {

        cartCollection() {
            return this.$page.props.cartCollection;
        }
    },

    methods: {

        cart() {

            this.cartM();
        },

        addToCart(categorySlug, productCode, cartForm = { quantity: 1 }) {

            this.addToCartM({
                categorySlug: categorySlug,
                productCode: productCode,
                cartForm: cartForm
            });
        }
    }

};