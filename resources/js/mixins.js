

import { mapMutations, mapState } from "vuex";
import { store } from './store';


// ------- App mixin --------

export const appMixin = {

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

    mounted() {

        this.getCart();
    },

    computed: {

        cartCollection() {
            return this.$page.props.cartCollection;
        }
    },

    methods: {

        getCart() {

            if(Object.keys(this.cartCollection).length != 0)
                if(Object.keys(this.cartCollectionS).length == 0) {

                    this.cartCollectionM(this.cartCollection);
                }
        },

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