
import { computed } from "vue";
import { useForm, usePage } from '@inertiajs/inertia-vue3';


export default function useCart() {


    // ------ Data -------

    const cartForm = useForm({
        quantity: 1,
        _method: 'patch'
    })


    // ------ Computed -------

    const cartCollection = computed(() => {    // Get cart on a server

        return usePage().props.value.cartCollection;
    })


    const cartId = computed(() => $('#cartId'))    // The cartId of the window(for show or hide)


    const cartCollectionKeys = computed(() => {

        return Object.keys(cartCollection.value);
    })


    const isCartData = computed(() => {

        return cartCollectionKeys.value.length;
    })


    const cartTotalCost = computed(() =>

        cartCollectionKeys.value.reduce(

            (total, key) =>
                total + cartCollection.value[key].cost,
            0
        )
    )


    // ------ Methods -------

    const showCart = () => {

        cartId.value.modal('show');
    }


    const hideCart = () => {

        cartId.value.modal('hide');
    }


    const addToCart = (categorySlug, productId, quantity) => {

        if(quantity > 0) cartForm.quantity = quantity;


        cartForm.post(route('cart.category.product.update', [categorySlug, productId]), {

            preserveScroll: true,

            onFinish: () => {
                if(!cartId.value.hasClass('show'))
                    cartId.value.modal('show');
            }
        });

    }


    const getCartProductCost = (product) => {

        product.cost = product.pivot.quantity * product.price;

        return product.cost;
    }


    return {
        cartForm,
        cartCollection,
        isCartData,
        cartTotalCost,
        showCart,
        hideCart,
        addToCart,
        getCartProductCost,
    }

};
