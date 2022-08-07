

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

        addToCart(categorySlug, productId, cartForm = { quantity: 1 }) {

            this.addToCartM({
                categorySlug: categorySlug,
                productId: productId,
                cartForm: cartForm
            });
        }
    }

};