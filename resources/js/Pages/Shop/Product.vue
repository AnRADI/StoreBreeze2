<template>
	<main-layout :can-login="canLogin" :can-register="canRegister">

		<head>
			<title> Продукт </title>
		</head>

		<div class="container">
			<div class="starter-template">
				<h1>{{ product.name }}</h1>
				<p>Цена: <b>{{ product.price }}.</b></p>
				<h4>
					<inertia-link :href="route('category', product.category.slug)">
						{{ product.category.name }}
					</inertia-link>
				</h4>
				<img src="http://internet-shop.tmweb.ru/storage/products/iphone_x.jpg">
				<p>{{ product.description }}</p>
				<form v-if="cartCollectionS[product.code]" @submit.prevent="cartM">
					<button type="submit" class="btn btn-primary" role="button">Уже в корзинe</button>
				</form>
				<form v-else @submit.prevent="addProductCartM({ productCode: product.code })">
					<button type="submit" class="btn btn-success">Добавить в корзину</button>
				</form>
			</div>
		</div>

	</main-layout>
</template>

<script>
    import MainLayout from "@/Layouts/MainLayout";
    import {mapMutations, mapState} from 'vuex';

    export default {

        components: {
            MainLayout
        },

        props: {
            product: Object,
            canLogin: Boolean,
            canRegister: Boolean,
			cartCollection: Object,
        },

        computed: {
            ...mapState([
                'cartCollectionS',
            ]),
        },

        methods: {
            ...mapMutations([
                'cartM',
                'addProductCartM',
				'cartCollectionM'
			])
		},

        watch: {

            cartCollection: {

                handler(value) {

                    if(Object.keys(value) != 0 && Object.keys(this.cartCollectionS) == 0) {

                        this.cartCollectionM(value);
                    }
                },
                immediate: true
            }

        }

    }
</script>