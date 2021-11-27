import {createStore} from "vuex";


export const store = createStore({

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