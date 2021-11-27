<template>
	<shop-layout :can-login="canLogin" :can-register="canRegister">

		<head>
			<title> Категория </title>
		</head>

		<div class="container">
			<div class="starter-template">
				<h1> {{ category.name }} </h1>
				<p> {{ category.description }} </p>
				<div class="row">
					<product-card
						v-for="product in category.products"
						:product="product"
						:category-slug="category.slug"
						:key="product.id"
					/>
				</div>
			</div>
		</div>

	</shop-layout>
</template>

<script>

    import ProductCard from "@/Components/ProductCard";
    import ShopLayout from "@/Layouts/ShopLayout";

    export default {

        components: {
            ShopLayout,
            ProductCard,
        },

        props: {
            category: Object,
            canLogin: Boolean,
            canRegister: Boolean,
        },

    }
</script>