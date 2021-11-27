<template>
	<shop-layout :can-login="canLogin" :can-register="canRegister">

		<head>
			<title> Продукт </title>
		</head>

		<div class="container">
			<div class="starter-template">
				<h1>{{ product.name }}</h1>
				<p>Цена: <b>{{ product.price }}.</b></p>
				<h4>
					<inertia-link :href="route('category', categorySlug)">
						{{ categoryName }}
					</inertia-link>
				</h4>
				<div class="row">
					<div class="col-md-8">
						<img class="img-fluid" :src="product.image">
					</div>
				</div>
				<p>{{ product.description }}</p>
				<form v-if="cartCollectionS[product.code]" @submit.prevent="cartM">
					<button type="submit" class="btn btn-primary" role="button">Уже в корзинe</button>
				</form>
				<form v-else @submit.prevent="addProductCartM({ productCode: product.code })">
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
            canLogin: Boolean,
            canRegister: Boolean,
			categoryName: String,
			categorySlug: String,
        }

    }
</script>