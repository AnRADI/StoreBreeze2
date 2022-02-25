<template>
	<shop-layout>

		<head>
			<title> Продукт </title>
		</head>

		<div class="container">
			<div class="starter-template">
				<h1>{{ product.name }}</h1>
				<p>Цена: <b>{{ product.price }}.</b></p>
				<h4>
					<inertia-link :href="route('category_slug', product.categories[0].slug)">
						{{ product.categories[0].name }}
					</inertia-link>
				</h4>
				<div class="row">
					<div class="col-md-8">
						<img class="img-fluid" :src="product.image">
					</div>
				</div>
				<p>{{ product.description }}</p>
				<form v-if="cartCollectionS[product.code]" @submit.prevent="cart">
					<button type="submit" class="btn btn-primary" role="button">Уже в корзинe</button>
				</form>
				<form v-else @submit.prevent="addToCart(product.categories[0].slug, product.code)">
					<button type="submit" class="btn btn-success">Добавить в корзину</button>
				</form>
			</div>
		</div>

	</shop-layout>
</template>

<script>

    import ShopLayout from "@/Layouts/ShopLayout";

    export default {

        components: {
            ShopLayout,
        },

        props: {
            product: Object,
        },

		methods: {

            cart() {

                document.getElementById('cart').click();
            },

            addToCart(categorySlug, productCode, cartForm = { quantity: 1 }) {

                this.addToCartM({
                    categorySlug: categorySlug,
                    productCode: productCode,
                    cartForm: cartForm
                });

                document.getElementById('addToCart').click();
            }
		}

    }
</script>