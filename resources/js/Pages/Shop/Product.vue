<template>
	<div>

		<Head>
			<title> Продукт </title>
		</Head>

		<div class="container">

			<div class="starter-template">
				<h1>{{ product.name }}</h1>
				<p>Цена: <b>{{ product.price }}.</b></p>
				<h4>
					<Link :href="route('categories.category.show', category.slug)">
						{{ category.name }}
					</Link>
				</h4>
				<div class="row">
					<div class="col-md-8">
						<img class="img-fluid" :src="product.image">
					</div>
				</div>
				<p>{{ product.description }}</p>
				<form v-if="cartCollection[product.id]" @submit.prevent="showCart">
					<button type="submit" class="btn btn-primary" role="button">Уже в корзинe</button>
				</form>
				<form v-else @submit.prevent="addToCart(category.slug, product.id)">
					<button type="submit" class="btn btn-success">Добавить в корзину</button>
				</form>
			</div>
		</div>

	</div>
</template>

<script>

    import ShopLayout from "@/Layouts/ShopLayout";
    import useCart from "@/Composables/useCart";


    export default {

        layout: ShopLayout,

        props: {
            category: Object,
            product: Object,
        },

        setup() {

            const { cartCollection, showCart, addToCart } = useCart();

            return {
                cartCollection,
                showCart,
                addToCart
            }
        },
    }
</script>
