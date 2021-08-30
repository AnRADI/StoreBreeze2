<template>
	<main-layout :can-login="canLogin" :can-register="canRegister">

		<head>
			<title> Категория </title>
		</head>

		<div class="container">
			<div class="starter-template">
				<h1> {{ category.name }} </h1>
				<p> {{ category.description }} </p>

				<div class="row">
					<product-card v-for="product in category.products" :key="product.id" :product="product" :cart-collection-s="cartCollectionS" />
				</div>
			</div>
		</div>

	</main-layout>
</template>

<script>
    import MainLayout from "@/Layouts/MainLayout";
    import ProductCard from "@/Components/ProductCard";
    import {mapMutations, mapState} from "vuex";

    export default {

        components: {
            ProductCard,
            MainLayout
        },

        props: {
            category: Object,
			cartCollection: [Object, Array],
            canLogin: Boolean,
            canRegister: Boolean,
        },

        methods: {
            ...mapMutations([

                'cartCollectionM'
            ]),
        },

        computed: {
            ...mapState([
                'cartCollectionS',
            ]),
        },

        watch: {

            cartCollection: {
                handler(value) {

					this.cartCollectionM(value);
                },
                immediate: true
            }

        }

    }
</script>