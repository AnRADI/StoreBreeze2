import {createStore} from "vuex";


export const store = createStore({

    state () {
        return {

            // Cart

            cartCollectionS: {},
            addToCartS: {}
        }
    },

    mutations: {

        // Cart

        cartCollectionM(state, value) {

            state.cartCollectionS = value;
        },

        addToCartM(state, value) {

            state.addToCartS = value;
        }
    }
});