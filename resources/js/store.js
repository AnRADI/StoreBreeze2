
import { createStore } from "vuex";


export const store = createStore({

    state () {
        return {

            // ------- Cart ---------

            cartCollectionS: {},
            cartS: false,
            addToCartS: {}
        }
    },

    mutations: {

        // ------- Cart ---------

        cartCollectionM(state, value) {

            state.cartCollectionS = value;
        },

        cartM(state) {

            state.cartS = !state.cartS;
        },

        addToCartM(state, params) {

            state.addToCartS = params;
        }
    }
});