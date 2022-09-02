
import { createStore } from "vuex";


export const store = createStore({

    state () {
        return {

            // ------- Cart ---------

            cartS: false,
            addToCartS: {}
        }
    },

    mutations: {

        // ------- Cart ---------

        cartM(state) {

            state.cartS = !state.cartS;
        },

        addToCartM(state, params) {

            state.addToCartS = params;
        }
    }
});